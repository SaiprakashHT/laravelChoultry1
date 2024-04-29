<?php

namespace App\Http\Controllers;

use App\Models\Outward;
use Illuminate\Http\Request;

class OutwardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $outward = Outward::all();
        return response()->json($outward);
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
            'id' => 'max:255',
            'vendor_name' => 'required',
            'vendor_phone' => 'required',
            'description' => 'required',
            'amount' => 'required',

        ]);

        $outward = Outward::create($request->all());
        return response()->json($outward);
    }

    /**
     * Display the specified resource.
     */
    public function show(Outward $outward)
    {
        //
        $outward = Outward::find($outward);
        return response()->json($outward);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outward $outward)
    {
        //
        $outward = Outward::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outward $outward)
    {
        //
        $request->validate([
            'id' => 'max:255',
            'vendor_name' => 'required',
            'vendor_phone' => 'required',
            'description' => 'required',
            'amount' => 'required',

        ]);

        $outward = Outward::find($id);
        $outward->update($request->all());
        return response()->json($outward);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outward $outward)
    {
        //
        $outward = Outward::find($id);
        $outward->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
