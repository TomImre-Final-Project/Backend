<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        return response()->json(Promotion::all());
    }

    public function show($id)
    {
        return response()->json(Promotion::findOrFail($id));
    }

    public function store(Request $request)
    {
        $promotion = new Promotion();
        $promotion->code = $request->code;
        $promotion->description = $request->description;
        $promotion->discount_percentage = $request->discount_percentage;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->is_active = $request->is_active;
        $promotion->save();
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::find($id);
        $promotion->description = $request->description;
        $promotion->discount_percentage = $request->discount_percentage;
        $promotion->start_date = $request->start_date;
        $promotion->end_date = $request->end_date;
        $promotion->is_active = $request->is_active;
        $promotion->save();
    }
    
    public function destroy($id)
    {
        Promotion::findOrFail($id)->delete();
        return response()->json(['message' => 'Promotion deleted successfully']);
    }
}
