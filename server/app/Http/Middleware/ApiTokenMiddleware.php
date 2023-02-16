<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check if the given token is valid
        $user = User::where('api_token', $request->header('Authorization'))->first();
        if (!$user) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
