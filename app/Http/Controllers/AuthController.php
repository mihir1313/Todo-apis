<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
{
    try {
        $validatedData = $request->validate([
            'email' => 'required|email',   
            'password' => 'required|min:6', 
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.', 
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least :min characters long.', 
        ]);
    } catch (ValidationException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation errors',
            'errors' => $e->errors(),
        ], 422);
    }

    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        $response['message'] = 'Invalid credentials';
        $response['status'] = 401;
        return response()->json($response, 401);
    }

    $token = $request->user()->createToken('authToken')->plainTextToken;
    $userId = $request->user()->id;

    return response()->json([
    'token' => $token,
    'user_id' => $userId, 
], 200);
}


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
