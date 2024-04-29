<?php

namespace App\Http\Controllers;

use App\Models\BookingItem;
use Illuminate\Http\Request;

class BookingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookingItem = BookingItem::all();
        return response()->json($bookingItem);
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
            'inventory_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required',

        ]);

        $bookingItem = BookingItem::create($request->all());
        return response()->json($bookingItem);
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingItem $bookingItem)
    {
        //
        $bookingItem = BookingItem::find($bookingItem);
        return response()->json($bookingItem);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingItem $bookingItem)
    {
        //
        $bookingItem = BookingItem::find($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingItem $bookingItem)
    {
        //
        $request->validate([
            'id' => 'max:255',
            'inventory_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required',

        ]);

        $bookingItem = BookingItem::find($id);
        $bookingItem->update($request->all());
        return response()->json($bookingItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingItem $bookingItem)
    {
        //
        $bookingItem = BookingItem::find($id);
        $bookingItem->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
