<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\UserService;
use Closure;

class ApiTokenMiddleware
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

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
        $user = $this->userService->checkIfUserExists($request->header('Authorization'));

        if (!$user) {
            return response()->json('Unauthorized', 401);
        }

        return $next($request);
    }
}
