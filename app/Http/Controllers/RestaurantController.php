<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json(Restaurant::with('manager')->get());
    }

    public function show($id)
    {
        return response()->json(Restaurant::with('manager')->findOrFail($id));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $restaurant = new Restaurant();
            $restaurant->name = $request->name;
            $restaurant->address = $request->address;
            $restaurant->phone = $request->phone;
            $restaurant->manager_id = $request->manager_id;
            $restaurant->status = $request->status;
            $restaurant->save();

            return response()->json([
                'message' => 'Restaurant created successfully',
                'restaurant' => $restaurant->load('manager')
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating restaurant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'manager_id' => 'nullable|exists:users,id',
            'status' => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->name = $request->name;
            $restaurant->address = $request->address;
            $restaurant->phone = $request->phone;
            $restaurant->manager_id = $request->manager_id;
            $restaurant->status = $request->status;
            $restaurant->save();

            return response()->json([
                'message' => 'Restaurant updated successfully',
                'restaurant' => $restaurant->load('manager')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating restaurant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the restaurant manager's restaurant
     */
    public function getMyRestaurant(Request $request)
    {
        try {
            $restaurant = Restaurant::where('manager_id', $request->user()->id)->first();
            
            if (!$restaurant) {
                return response()->json([
                    'message' => 'No restaurant found for this manager'
                ], 404);
            }

            return response()->json($restaurant->load('manager'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching restaurant',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the restaurant manager's restaurant
     */
    public function updateMyRestaurant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:active,inactive'
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

            $restaurant->name = $request->name;
            $restaurant->address = $request->address;
            $restaurant->phone = $request->phone;
            $restaurant->status = $request->status;
            $restaurant->save();

            return response()->json([
                'message' => 'Restaurant updated successfully',
                'restaurant' => $restaurant->load('manager')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating restaurant',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function destroy($id)
    {
        try {
            Restaurant::findOrFail($id)->delete();
            return response()->json(['message' => 'Restaurant deleted successfully']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting restaurant',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
