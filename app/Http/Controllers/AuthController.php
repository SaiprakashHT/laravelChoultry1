<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;

class AuthController extends Controller
{
    /**
    * Create user
    *
    * @param  [string] name
    * @param  [string] email
    * @param  [string] password
    * @param  [string] password_confirmation
    * @return [string] message
    */
    public function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        //     'phone' => 'required|numeric',
        //     'email'=>'required|string|unique:users',
        //     'password'=>'required|string',
        //     'c_password' => 'required|same:password'
        // ]);

        // $user = new User([
        //     'name'  => $request->name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'password' => bcrypt($request->password),
        // ]);

        // if($user->save()){
        //     $tokenResult = $user->createToken('Personal Access Token');
        //     $token = $tokenResult->plainTextToken;

        //     return response()->json([
        //     'message' => 'Successfully created user!',
        //     'accessToken'=> $token,
        //     ],201);
        // }
        // else{
        //     return response()->json(['error'=>'Provide proper details']);
        // }

        $rules = [
            'name' => 'required|string',
            'phone' => 'required|numeric',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' =>Hash::make($request->password),
        ]);
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $response = ['user'=> $user, 'token'=>$token];
        return response()->json($response, 200);

    }

    /**
     * Login user and create token
    *
    * @param  [string] email
    * @param  [string] password
    * @param  [boolean] remember_me
    */

    public function login(Request $request)
    {
        // $request->validate([
        // 'phone' => 'required|numeric',
        // 'password' => 'required|string',
        // // 'remember_me' => 'boolean'
        // ]);

        // $credentials = request(['phone','password']);
        // if(!Auth::attempt($credentials))
        // {
        // return response()->json([
        //     'message' => 'Unauthorized'
        // ],401);
        // }

        // $user = $request->user();
        // $tokenResult = $user->createToken('Personal Access Token');
        // $token = $tokenResult->plainTextToken;

        // return response()->json([
        // 'accessToken' =>$token,
        // 'token_type' => 'Bearer',
        // ]);
        $rules = [
            'phone' => 'required|numeric',
            'password'=>'required|string',
        ];
        $request->validate($rules);
        $user = User::where('phone', $request->phone)->first();
        if($user && Hash::check($request->password, $user->password)){
            $token = $user->createToken('Personal Access Token')->plainTextToken;
            $user_roles = UserRole::where([["user_id", "=", $user->id]])->get();
            $user_roles_array = array();
            foreach($user_roles as $index=>$user_role){
                $role = Role::find($user_role->role_id);
                array_push($user_roles_array, $role->name);
            }
            $response=['user'=>$user, 'token'=>$token, 'role' => $user_roles_array];
            return response()->json($response, 200);

        }
    $response = ['message'=>'Incorrect email and password'];
    return response()->json($response, 400);




    }

    /**
     * Get the authenticated User
    *
    * @return [json] user object
    */
    public function user(Request $request)
    {
        // return response()->json($request->user());
        return User::all();
    }

    /**
     * Logout user (Revoke the token)
    *
    * @return [string] message
    */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
        'message' => 'Successfully logged out'
        ]);

    }

    // public function otpValidation(Request $request)
    // {
    //     $request->validate([
    //         'otp' => 'required',
    //         'user_id' => 'required|exists:users,id'
    //     ]);

    //     $user = User::where('phone', $request->phone) where('otp', $request->otp)->first();

    //     $now = now();
    //     if(!$user){
    //         return redirect()->back()->with('error, Your OTP does not match')
    //     }
    //     elseif($user && $now->isAfter($user->expire_at)){
    //         return redirect()->back()->with('error, Your OTP has been Expired')
    //     }
    // }
}