<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $role = Role::all();
        return response()->json($role);
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
            'name' => 'required',

        ]);

        $role = Role::create($request->all());
        return response()->json($role);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $role = Role::find($id);
        return response()->json($role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
        $role = Role::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',

        ]);

        $role = Role::find($id);
        $role->update($request->all());
        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $role = Role::find($id);
        $role->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
