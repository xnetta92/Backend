<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( StoreUserRequest $request){
        #$user = User::create($request->validated());
        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "role" => $request->role,
            "phone" => $request->phone,
            "address" => $request->address,
            "zip" => $request->zip,
            "city" => $request->city,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        #$token = $user->createToken('AuthToken')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully!',
        #    'token' =>$token,
        #    'Type' => 'Bearer'
        ]);
    }


    public function login(Request $request)
    {
        /*$fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);*/

        #$user = User::where('email', $fields['email'])->first();
        $user = User::where("email", $request->email)->first();

        #if (!$user || !Hash::check($fields['password'], $user->password)) {
        #if (!$user || !bcrypt($fields['password']) == $user->password) {
        if (!$user) {
            return response()->json(["message" => "User not valid"], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Incorrect password"], 401);
        }

        #$token = $user->createToken('my-token', ['role' => $user->role, 'expires_at' => now()->addMinutes(5)])->plainTextToken;
        $token = $user->createToken("AuthToken")->plainTextToken;

        return response()->json([
            'message' => 'Succesfull login!',
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role // include user role in response
        ]);
    }

    public function logout(Request $request) {
        // Token által hitelesített felhasználó lekérdezése
        // $user = $request->user();
        // $user = Auth::user();

        $user = auth()->user();
        /** @disregard P1013 Undefined method */
        $user->currentAccessToken()->delete();
        return response()->noContent();
    }

    public function logoutEverywhere() {
        $user = auth()->user();
        /** @disregard P1013 Undefined method */
        $user->tokens()->delete();
        return response()->noContent();
    }

}
