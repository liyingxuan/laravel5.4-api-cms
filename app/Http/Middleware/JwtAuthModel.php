<?php

namespace App\Http\Middleware;

use Closure;

class JwtAuthModel
{
    public function handle($request, Closure $next)
    {
        config(['jwt.user' => '\App\Models\Api\User']); //用于重定位model
        config(['auth.providers.users.model' => \App\Models\Api\User::class]); //用于重定位model

        return $next($request);
    }
}
