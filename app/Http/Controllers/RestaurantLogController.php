<?php

namespace App\Http\Controllers;

use App\Models\RestaurantLog;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantLogController extends Controller
{
    public function index()
    {
        return response()->json(RestaurantLog::all());
    }

    public function show($id)
    {
        return response()->json(RestaurantLog::findOrFail($id));
    }

    public function store(Request $request)
    {
        $log = new RestaurantLog();
        $log->restaurant_id = $request->restaurant_id;
        $log->status = $request->status;
        $log->until = $request->until;
        $log->save();
    }

    public function update(Request $request, $id)
    {
        $log = RestaurantLog::find($id);
        $log->status = $request->status;
        $log->until = $request->until;
        $log->save();
    }
    
    public function destroy($id)
    {
        RestaurantLog::findOrFail($id)->delete();
        return response()->json(['message' => 'Restaurant log deleted successfully']);
    }

    public function getDishes(Restaurant $restaurant)
    {
        $dishes = $restaurant->dishes;
        return response()->json($dishes);
    }
}
