<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // define the validation rules and validate the request
        $rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];

        $this->validate($request, $rules);

        // generate a new api token for the user
        $token = Str::random(80);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => app('hash')->make($request->password),
            'api_token' => $token
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user
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
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Invalid credentials or user does not exist'
            ], 401);
        }

        // check if the password is correct
        if (!app('hash')->check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials or user does not exist'
            ], 401);
        }

        // generate a new api token for the user
        $token = Str::random(80);

        $user->update([
            'api_token' => $token
        ]);

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user
        ], 200);
    }

    public function validateToken(Request $request, $token)
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
