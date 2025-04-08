<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
            'status' => 'required|in:pending,in_delivery,delivered,cancelled',
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
            'courier_id' => 'nullable|exists:users,id',
            'order_date' => 'required|date',
            'status' => 'required|in:pending,in_delivery,delivered,cancelled',
            'total_price' => 'required|integer|min:0',
            'special_instructions' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $order = Order::findOrFail($id);
            $order->courier_id = $request->courier_id;
            $order->order_date = $request->order_date;
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
}