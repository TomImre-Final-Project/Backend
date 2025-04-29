<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function show($id)
    {
        return response()->json(Order::findOrFail($id));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'restaurant_id' => 'required|exists:restaurants,id',
            'courier_id' => 'nullable|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,confirmed,ready,delivering,delivered,cancelled',
            'total_price' => 'required|integer|min:0',
            'special_instructions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->restaurant_id = $request->restaurant_id;
            $order->courier_id = $request->courier_id;
            $order->order_date = Carbon::parse($request->order_date)->format('Y-m-d H:i:s');
            $order->status = $request->status;
            $order->total_price = $request->total_price;
            $order->special_instructions = $request->special_instructions;
            $order->save();

            return response()->json([
                'message' => 'Order created successfully',
                'order' => $order
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,ready,delivering,delivered,cancelled',
            'total_price' => 'required|integer|min:0',
            'special_instructions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $order = Order::findOrFail($id);
            $order->status = $request->status;
            $order->total_price = $request->total_price;
            $order->special_instructions = $request->special_instructions;
            $order->save();

            return response()->json([
                'message' => 'Order updated successfully',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json(['message' => 'Order deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * List all orders for admin panel
     */
    public function listOrders()
    {
        $orders = Order::with(['user', 'restaurant', 'courier'])->get();
        return response()->json($orders);
    }

    /**
     * Place an order (customer specific)
     */
    public function placeOrder(Request $request)
    {
        // This method would be used for customers to place orders
        // Implementation would be similar to store but with additional validation
        // and possibly different business logic
        return $this->store($request);
    }

    /**
     * Get orders that are ready for delivery
     */
    public function getDeliverableOrders()
    {
        $orders = Order::with(['user', 'restaurant'])
            ->where('status', 'ready')
            ->get();
        return response()->json($orders);
    }

    /**
     * Get orders assigned to the current courier
     */
    public function getMyDeliveries(Request $request)
    {
        $courierId = $request->user()->id;
        $orders = Order::with(['user', 'restaurant'])
            ->where('courier_id', $courierId)
            ->whereIn('status', ['delivering', 'delivered'])
            ->get();
        return response()->json($orders);
    }

    /**
     * Accept an order for delivery
     */
    public function acceptOrder(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            // Check if the order is ready for delivery
            if ($order->status !== 'ready') {
                return response()->json([
                    'message' => 'This order is not ready for delivery'
                ], 400);
            }
            
            // Check if the order is already assigned to a courier
            if ($order->courier_id !== null) {
                return response()->json([
                    'message' => 'This order is already assigned to a courier'
                ], 400);
            }
            
            // Assign the order to the current courier
            $order->courier_id = $request->user()->id;
            $order->status = 'delivering';
            $order->save();
            
            return response()->json([
                'message' => 'Order accepted for delivery',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error accepting order',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark an order as delivered
     */
    public function markAsDelivered(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            
            // Check if the order is assigned to the current courier
            if ($order->courier_id !== $request->user()->id) {
                return response()->json([
                    'message' => 'This order is not assigned to you'
                ], 403);
            }
            
            // Check if the order is in delivering status
            if ($order->status !== 'delivering') {
                return response()->json([
                    'message' => 'This order is not in delivering status'
                ], 400);
            }
            
            // Update the order status
            $order->status = 'delivered';
            $order->delivered_at = now();
            $order->save();
            
            return response()->json([
                'message' => 'Order marked as delivered',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error marking order as delivered',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get orders for the restaurant manager's restaurant
     */
    public function getRestaurantOrders(Request $request)
    {
        $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
        if (!$restaurant) {
            return response()->json([
                'message' => 'No restaurant found for this manager'
            ], 404);
        }

        $orders = Order::with(['user', 'restaurant', 'orderItems.dish'])
            ->where('restaurant_id', $restaurant->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($orders);
    }

    /**
     * Update an order's status and details (restaurant manager specific)
     */
    public function updateOrder(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,ready,delivering,delivered,cancelled',
            'special_instructions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
            if (!$restaurant) {
                return response()->json([
                    'message' => 'No restaurant found for this manager'
                ], 404);
            }

            $order = Order::findOrFail($id);
            
            // Check if the order belongs to the restaurant manager's restaurant
            if ($order->restaurant_id !== $restaurant->id) {
                return response()->json([
                    'message' => 'Unauthorized to update this order'
                ], 403);
            }

            $order->status = $request->status;
            if ($request->has('special_instructions')) {
                $order->special_instructions = $request->special_instructions;
            }
            $order->save();

            return response()->json([
                'message' => 'Order updated successfully',
                'order' => $order
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}