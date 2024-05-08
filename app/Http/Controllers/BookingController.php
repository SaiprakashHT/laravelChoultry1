<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\BookingItem;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookings = Booking::all();
        foreach($bookings as $index=>$booking){
            $customer = Customer::find($booking->customer_id);
            $booking["customer_name"] = $customer->name;
            $booking["customer_phone"] = $customer->phone;
            $booking["customer_address"] = $customer->address;
            $booking["customer_pincode"] = $customer->pincode;
            $booking["customer_gst_no"] = $customer->gst_no;
            $bookings[$index] = $booking;
        }
        return response()->json($bookings);
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
            'customer_phone' => 'required',
            'total' => 'required'
        ]);

        $customer = new Customer();
        $request_param = $request->all();
        $customer->name = $request_param["customer_name"];
        $customer->phone = $request_param["customer_phone"];
        $customer->address = $request_param["customer_address"];
        $customer->pincode = $request_param["customer_pincode"];
        $customer->gst_no = $request_param["customer_gst_no"];
        $customer->user_id = $request->user()->id;
        $customer->save();
        $booking = new Booking($request->all());
        $booking->customer_id = $customer->id;
        $booking->user_id = $request->user()->id;
        $current_time = Carbon::now();
        $booking->advance_date_time = $current_time;
        $booking->save();
        
        $booking_items = $request_param["booking_items"];
        foreach($booking_items as $index=>$booking_item){
            $booking_item_obj = new BookingItem();
            $booking_item_obj->inventory_id = $booking_item["inventory_id"];
            $booking_item_obj->price = $booking_item["price"];
            $booking_item_obj->quantity = $booking_item["quantity"];
            $booking_item_obj->total = $booking_item["total"];
            $booking_item_obj->booking_id = $booking->id;
            $booking_item_obj->save();
        }

        return response()->json($booking);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $booking = Booking::find($id);
        $customer = Customer::find($booking->customer_id);
        $booking["customer_name"] = $customer->name;
        $booking["customer_phone"] = $customer->phone;
        $booking["customer_address"] = $customer->address;
        $booking["customer_pincode"] = $customer->pincode;
        $booking["customer_gst_no"] = $customer->gst_no;
        $booking_items = BookingItem::where([['booking_id', '=', $booking->id]])->get();

        $booking["booking_items"] = $booking_items;
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'advance' => 'required',
            'customer_phone' => 'required',
            'total' => 'required'
        ]);
        $booking = Booking::find($id);
        $customer = Customer::find($booking->customer_id);

        $request_param = $request->all();
        $customer->name = $request_param["customer_name"];
        $customer->phone = $request_param["customer_phone"];
        $customer->address = $request_param["customer_address"];
        $customer->pincode = $request_param["customer_pincode"];
        $customer->gst_no = $request_param["customer_gst_no"];
        $customer->user_id = $request->user()->id;
        $customer->save();
        $booking->update($request->all());
        $booking->customer_id = $customer->id;
        $booking->user_id = $request->user()->id;
        $current_time = Carbon::now();
        $booking->advance_date_time = $current_time;
        $booking->save();
        
        // $booking_items = BookingItem::where([['booking_id', '=', $booking->id]]);

        $booking_items = $request_param["booking_items"];
        foreach($booking_items as $index=>$booking_item){
            if(array_key_exists("id", $booking_item)){
                $booking_item_obj = BookingItem::find($booking_item["id"]);
            }else{
                $booking_item_obj = new BookingItem();
            }
            $booking_item_obj->inventory_id = $booking_item["inventory_id"];
            $booking_item_obj->price = $booking_item["price"];
            $booking_item_obj->quantity = $booking_item["quantity"];
            $booking_item_obj->total = $booking_item["total"];
            $booking_item_obj->booking_id = $booking->id;
            $booking_item_obj->save();
        }

        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $booking = Booking::find($id);
        $booking_items = BookingItem::where([['booking_id', '=', $booking->id]])->get();
        foreach($booking_items as $index=>$booking_item){
            $booking_item->delete();
        }
        $customer = Customer::find($booking->customer_id);
        $customer->delete();
        
        $booking->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
