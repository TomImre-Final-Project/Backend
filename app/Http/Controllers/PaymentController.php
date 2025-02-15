<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(Payment::all());
    }

    public function show($id)
    {
        return response()->json(Payment::findOrFail($id));
    }

    public function store(Request $request)
    {
        $payment = new Payment();
        $payment->order_id = $request->order_id;
        $payment->status = $request->status;
        $payment->method = $request->method;
        $payment->transaction_id = $request->transaction_id;
        $payment->payment_date = $request->payment_date;
        $payment->save();
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        $payment->status = $request->status;
        $payment->payment_date = $request->payment_date;
        $payment->save();
    }
    
    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
