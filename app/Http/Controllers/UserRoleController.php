<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user_roles = UserRole::all();
        return response()->json($user_roles);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'user_id' => '',
            'role_id' => '',
            'choultry_id' => '',

        ]);
        $user_role = new UserRole($request->all());
        $user_role->save();
        return response()->json($user_role);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user_role = UserRole::find($id);
        return response()->json($user_role);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => '',
            'role_id' => '',
            'choultry_id' => '',

        ]);
        $user_role = UserRole::find($id);
        $user_role->update($request->all());
        $user_role->save();
        return response()->json($user_role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_role = UserRole::find($id);
        $user_role->delete();
        return response()->json(['message' => 'Successfully deleted']);
    }
}
