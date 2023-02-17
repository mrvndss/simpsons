<?php

namespace App\Services;

use Illuminate\Support\Str;

class TokenService
{
    public function generateToken()
    {
        $token = Str::random(80);
        return $token;
    }
}
