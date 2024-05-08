<?php

namespace App\Http\Controllers;

use App\Models\Choultry;
use Illuminate\Http\Request;

class ChoultryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $choultries = Choultry::where([["user_id", "=", $request->user()->id]])->get();
        return response()->json($choultries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id' => 'max:255',
            'name' => 'required|max:255',
            'address' => 'required',
            'pin' => 'required',
            'phone_number' => 'required',
            'email' => 'required|unique:choultries',
            'pname' => 'required'

        ]);
        
        $choultry = new Choultry($request->all());
        $choultry->user_id = $request->user()->id;
        $choultry->save();
        return response()->json($choultry);
        // return redirect()->route('posts.index')
        //     ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        // printf('show function');
        $choultry = Choultry::find($id);
        return response()->json($choultry);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // print_r($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'pin' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'pname' => 'required',

        ]);
        $choultry = Choultry::find($id);
        $choultry->update($request->all());
        return response()->json($choultry);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $choultry = Choultry::find($id);
        $choultry->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
