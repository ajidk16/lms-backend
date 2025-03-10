<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authServices;

    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;    
    }

    public function register(RegisterRequest $request) 
    {
        $validatedData = $request->validated();

        $user = $this->authServices->registerUser($validatedData);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token
        ]);
    }

    public function login(LoginRequest $request) 
    {

        $credentials = $request->only('email', 'password');
        
        $user = $this->authServices->loginUser($credentials);
        $token = $user->createToken('auth_token')->plainTextToken;
        
        if (!$user)  {
            // dd('masuk', $user);
            return response()->json(['message' => 'invalid credentials'], 201);
        }

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token
        ])->header('Cache-Control', 'no-cache, no-store, must-revalidate');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
