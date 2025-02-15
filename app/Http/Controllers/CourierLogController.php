<?php

namespace App\Http\Controllers;

use App\Models\CourierLog;
use Illuminate\Http\Request;

class CourierLogController extends Controller
{
    public function index()
    {
        return response()->json(CourierLog::all());
    }

    public function show($id)
    {
        return response()->json(CourierLog::findOrFail($id));
    }

    public function store(Request $request)
    {
        $log = new CourierLog();
        $log->courier_id = $request->courier_id;
        $log->order_id = $request->order_id;
        $log->action = $request->action;
        $log->save();
    }

    public function update(Request $request, $id)
    {
        $log = CourierLog::find($id);
        $log->action = $request->action;
        $log->save();
    }
    
    public function destroy($id)
    {
        CourierLog::findOrFail($id)->delete();
        return response()->json(['message' => 'Courier log deleted successfully']);
    }
}
