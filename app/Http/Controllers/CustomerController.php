<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customer = Customer::all();
        return response()->json($customer);
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
            'id' => 'required|max:255',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'pincode' => 'required',
            'gst_no' => 'required',

        ]);

        $customer = Customer::create($request->all());
        return response()->json($customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        $customer = Customer::find($customer);
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        $customer = Customer::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $request->validate([
            'id' => 'required|max:255',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'pincode' => 'required',
            'gst_no' => 'required',

        ]);

        $customer = Customer::find($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
