<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;


class AuthController extends Controller
{
        // Register a new user
        public function register(RegisterRequest $request)
        {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
    
            return response()->json(['message' => 'User registered successfully'], 201);
        }
    
        // Login and issue token
        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');
    
            if (auth('api')->attempt($credentials)) {
                // $user = auth('api')->user();
                // $token = $user->createToken('authToken')->accessToken;
                // return response()->json(['token' => $token], 200);
            }
    
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        // Get authenticated user details
        public function user(Request $request)
        {
            return response()->json($request->user());
        }
    
        // Logout and revoke token
        public function logout(Request $request)
        {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Logged out successfully'], 200);
        }
    
}
