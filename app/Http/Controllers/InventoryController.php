<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventory = Inventory::all();
        return response()->json($inventory);
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
            'price' => 'required',
            'stock' => 'required',
            'igst' => 'required',
            'sgst' => 'required',
            'cgst' => 'required',

        ]);

        $inventory = Inventory::create($request->all());
        return response()->json($inventory);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
        $inventory = Inventory::find($inventory);
        return response()->json($inventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
        $inventory = Inventory::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
        $request->validate([
            'id' => 'required|max:255',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'igst' => 'required',
            'sgst' => 'required',
            'cgst' => 'required',

        ]);

        $inventory = Inventory::find($id);
        $inventory->update($request->all());
        return response()->json($inventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
        $inventory = Inventory::find($id);
        $inventory->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
