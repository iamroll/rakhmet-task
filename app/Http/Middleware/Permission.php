<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Permission
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
        if (auth()->guest() || auth()->user()->role == User::GUEST) {
            return response()
                ->json(["error" => "Unauthorized"], 401);
        }
        return $next($request);
    }
}
