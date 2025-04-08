<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    public function index()
    {
        return response()->json(OrderItem::all());
    }

    public function show($id)
    {
        return response()->json(OrderItem::findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'dish_id' => 'required|exists:dishes,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $orderItem = new OrderItem();
            $orderItem->order_id = $request->order_id;
            $orderItem->dish_id = $request->dish_id;
            $orderItem->quantity = $request->quantity;
            $orderItem->price = $request->price;
            $orderItem->save();

            return response()->json([
                'message' => 'Order item created successfully',
                'order_item' => $orderItem
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->quantity = $request->quantity;
            $orderItem->price = $request->price;
            $orderItem->save();

            return response()->json([
                'message' => 'Order item updated successfully',
                'order_item' => $orderItem
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $orderItem = OrderItem::findOrFail($id);
            $orderItem->delete();
            return response()->json(['message' => 'Order item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting order item',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
