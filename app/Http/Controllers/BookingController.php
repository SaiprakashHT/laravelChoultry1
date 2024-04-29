<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $booking = Booking::all();
        return response()->json($booking);
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
            'start_date' => 'required',
            'end_date' => 'required',
            'advance' => 'required',
            'total' => 'required'
        ]);

        $customer = new Customer();
        $request_param = $request->all();
        $customer->name = $request_param->customer_name;
        $customer->phone = $request_param->customer_phone;
        $customer->address = $request_param->customer_address;
        $customer->pincode = $request_param->customer_pincode;
        $customer->gst_no = $request_param->customer_gst_no;
        $customer->user_id = $request->user()->id;
        $customer->save();
        $booking = new Booking($request->all());
        $booking->customer_id = $customer->id;
        $current_time = Carbon\Carbon::now();
        $booking->advance_date_time = $current_time;
        $booking->save();
        
        $booking_items = $request_param->booking_items;
        foreach($booking_items as $index=>$booking_item){
            $booking_item_obj = new BookingItem();
            $booking_item_obj->inventory_id = $booking_item->inventory_id;
            $booking_item_obj->price = $booking_item->price;
            $booking_item_obj->quantity = $booking_item->quantity;
            $booking_item_obj->total = $booking_item->total;
            $booking_item_obj->booking_id = $booking->id;
            $booking_item_obj->save();
        }

        return response()->json($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
        $booking = Booking::find($booking);
        return response()->json($booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
        $booking = Booking::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
        $request->validate([
            'id' => 'max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'advance' => 'required',
            'advance_date_time' => 'required',
            'total' => 'required',

        ]);

        $booking = Booking::find($id);
        $booking->update($request->all());
        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
        $booking = Booking::find($id);
        $booking->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
