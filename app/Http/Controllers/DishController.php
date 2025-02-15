<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        return response()->json(Dish::all());
    }

    public function show($id)
    {
        return response()->json(Dish::findOrFail($id));
    }

    public function store(Request $request)
    {
        $dish = new Dish();
        $dish->name = $request->name;
        $dish->restaurant_id = $request->restaurant_id;
        $dish->category_id = $request->category_id;
        $dish->price = $request->price;
        $dish->ingredients = $request->ingredients;
        $dish->is_available = $request->is_available;
        $dish->image = $request->image;
        $dish->save();
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::find($id);
        $dish->name = $request->name;
        $dish->restaurant_id = $request->restaurant_id;
        $dish->category_id = $request->category_id;
        $dish->price = $request->price;
        $dish->ingredients = $request->ingredients;
        $dish->is_available = $request->is_available;
        $dish->image = $request->image;
        $dish->save();
    }
    
    public function destroy($id)
    {
        Dish::findOrFail($id)->delete();
        return response()->json(['message' => 'Dish deleted successfully']);
    }
}
