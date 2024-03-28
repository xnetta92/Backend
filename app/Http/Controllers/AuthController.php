<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
#use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register( StoreUserRequest $request){
        $user = User::create($request->validated());
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer'
        ]);
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        #if (!$user || !Hash::check($fields['password'], $user->password)) {
        if (!$user || !bcrypt($fields['password']) == $user->password) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        #$token = $user->createToken('my-token', ['role' => $user->role, 'expires_at' => now()->addMinutes(5)])->plainTextToken;
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer',
            'role' => $user->role // include user role in response
        ]);
    }
}
