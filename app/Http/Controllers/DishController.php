<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant;
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
        try {
            $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
            
            if (!$restaurant) {
                return response()->json([
                    'message' => 'No restaurant found for this manager'
                ], 404);
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'ingredients' => 'required|string',
                'is_available' => 'boolean',
                'image' => 'nullable|image|max:2048'
            ]);

            $dish = new Dish();
            $dish->name = $request->name;
            $dish->description = $request->description;
            $dish->price = $request->price;
            $dish->restaurant_id = $restaurant->id;
            $dish->category_id = $request->category_id;
            $dish->ingredients = $request->ingredients;
            $dish->is_available = $request->is_available ?? true;
            
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('dishes', 'public');
                $dish->image = $path;
            }
            
            $dish->save();

            return response()->json([
                'message' => 'Dish created successfully',
                'dish' => $dish
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating dish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
            
            if (!$restaurant) {
                return response()->json([
                    'message' => 'No restaurant found for this manager'
                ], 404);
            }

            $dish = Dish::where('restaurant_id', $restaurant->id)
                       ->where('id', $id)
                       ->firstOrFail();

            // If only is_available is being updated (toggle operation)
            if ($request->has('is_available') && count($request->all()) === 1) {
                $request->validate([
                    'is_available' => 'required|boolean'
                ]);
                $dish->is_available = $request->is_available;
            } else {
                // Full update validation
                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'price' => 'required|integer|min:0',
                    'category_id' => 'required|exists:categories,id',
                    'ingredients' => 'required|string',
                    'is_available' => 'required|boolean',
                    'image' => 'nullable|image|max:2048'
                ]);

                $dish->name = $request->name;
                $dish->description = $request->description;
                $dish->price = $request->price;
                $dish->category_id = $request->category_id;
                $dish->ingredients = $request->ingredients;
                $dish->is_available = $request->is_available;
                
                if ($request->hasFile('image')) {
                    $path = $request->file('image')->store('dishes', 'public');
                    $dish->image = $path;
                }
            }
            
            $dish->save();

            return response()->json([
                'message' => 'Dish updated successfully',
                'dish' => $dish
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating dish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getByRestaurant($restaurantId)
    {
        $dishes = Dish::where('restaurant_id', $restaurantId)->get();

        return response()->json($dishes);
    }
    
    public function destroy($id)
    {
        try {
            $dish = Dish::findOrFail($id);
            $dish->delete();
            return response()->json(['message' => 'Dish deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting dish',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMyRestaurantDishes(Request $request)
    {
        try {
            $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
            
            if (!$restaurant) {
                return response()->json([
                    'message' => 'No restaurant found for this manager'
                ], 404);
            }

            $dishes = Dish::where('restaurant_id', $restaurant->id)->get();
            return response()->json($dishes);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching dishes',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
