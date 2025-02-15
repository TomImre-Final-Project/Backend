<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json(Restaurant::all());
    }

    public function show($id)
    {
        return response()->json(Restaurant::findOrFail($id));
    }

    public function store(Request $request)
    {
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->phone = $request->phone;
        $restaurant->manager_id = $request->manager_id;
        $restaurant->status = $request->status;
        $restaurant->save();
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->name = $request->name;
        $restaurant->address = $request->address;
        $restaurant->phone = $request->phone;
        $restaurant->manager_id = $request->manager_id;
        $restaurant->status = $request->status;
        $restaurant->save();
    }
    
    public function destroy($id)
    {
        Restaurant::findOrFail($id)->delete();
        return response()->json(['message' => 'Restaurant deleted successfully']);
    }
}
