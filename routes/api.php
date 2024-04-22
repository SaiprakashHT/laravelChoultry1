<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
 
    return ['token' => $token->plainTextToken];
});

Route::resource('choultries', 'ChoultryController');

Route::get('/products', function(Request $request){
    return 'products';
});


Route::post('/register', function (Request $req)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        // ]);

        // validate
        $rules=[
            'name'=>'required|string',
            'phone_number'=>'char|unique:users',
            'email'=>'required|string|unique:users',
            'password'=>'required|string|min:6',
        ];

        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        //create new user in users table
        $user = User::create([
            'name'=>$req->name,
            'phone_number'=>$req->phone_number,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);

        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $response = ['user'=> $user, 'token'=>$token];
        return response()->json($response, 200);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();

        //return response()->json(['message' => 'User registered successfully'], 201);
    } );

 
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    
    $user = User::where('email', $request->email)->first();
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
 
    return $user->createToken($request->device_name)->plainTextToken;
});

// Route::get('/users/{id}/edit', [AuthenticationController::class,'edit'])->name('users.edit'); 

// Route::delete('/users/{id}/delete', [AuthenticationController::class,'delete'])->name('users.delete'); 


Route::middleware('cors')->group(function () {
    // routes...
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});