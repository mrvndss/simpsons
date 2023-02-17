<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $tokenService;

    public function __construct()
    {
        $this->tokenService = new TokenService();
    }

    public function createUser($name, $email, $password)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => app('hash')->make($password),
            'api_token' => $this->tokenService->generateToken(),
        ]);
    }

    public function checkIfUserExists($identifier)
    {
        return User::where('email', $identifier)->orWhere('api_token', $identifier)->first();
    }

    public function validatePassword($password, $user)
    {
        return app('hash')->check($password, $user->password);
    }
}
