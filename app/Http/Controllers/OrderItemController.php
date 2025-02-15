<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

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
        $orderItem = new OrderItem();
        $orderItem->order_id = $request->order_id;
        $orderItem->dish_id = $request->dish_id;
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $request->price;
        $orderItem->save();
    }

    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        $orderItem->quantity = $request->quantity;
        $orderItem->price = $request->price;
        $orderItem->save();
    }

    public function destroy($id)
    {
        OrderItem::findOrFail($id)->delete();
        return response()->json(['message' => 'Order item deleted successfully']);
    }
}
