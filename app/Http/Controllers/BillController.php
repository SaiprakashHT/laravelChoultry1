<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bill = Bill::all();
        return response()->json($bill);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'booking_id' => 'max:255',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'customer_gst' => 'required',
            'bill_no' => 'required',
            'paid' => 'required',
            'paid_date_time' => 'required',

        ]);

        $bill = Bill::create($request->all());
        return response()->json($bill);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $bill = Bill::find($id);
        return response()->json($bill);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
        $bill = Bill::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'booking_id' => 'max:255',
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'customer_gst' => 'required',
            'bill_no' => 'required',
            'paid' => 'required',
            'paid_date_time' => 'required',

        ]);

        $bill = Bill::find($id);
        $bill->update($request->all());
        return response()->json($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $bill = Bill::find($id);
        $bill->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
