<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

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
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->restaurant_id = $request->restaurant_id;
        $order->courier_id = $request->courier_id;
        $order->order_date = $request->order_date;
        $order->status = $request->status;
        $order->total_price = $request->total_price;
        $order->special_instructions = $request->special_instructions;
        $order->save();

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->order_date = $request->order_date;
        $order->total_price = $request->total_price;
        $order->special_instructions = $request->special_instructions;
        $order->save();

        return response()->json($order);
    }

    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
