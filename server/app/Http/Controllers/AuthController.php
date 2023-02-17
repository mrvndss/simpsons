<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;
    protected $tokenService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->tokenService = new TokenService();
    }

    public function register(Request $request)
    {
        // define the validation rules and validate the request
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];

        $this->validate($request, $rules);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $this->userService->createUser($request->name, $request->email, $request->password)
        ], 201);
    }

    public function login(Request $request)
    {
        // define the validation rules and validate the request
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];

        $this->validate($request, $rules);

        // check if the user exists
        $user = $this->userService->checkIfUserExists($request->email);

        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials or user does not exist'
            ], 401);
        }

        // check if the password is correct
        if (!$this->userService->validatePassword($request->password, $user)) {
            return response()->json([
                'message' => 'Invalid credentials or user does not exist'
            ], 401);
        }

        $user->update([
            'api_token' => $this->tokenService->generateToken(),
        ]);

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user
        ], 200);
    }

    public function validateToken($token)
    {
        // check if user with given token exists
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid token or user does not exist'
            ], 401);
        }

        return response()->json([
            'message' => 'Token is valid',
            'user' => $user
        ], 200);
    }
}
