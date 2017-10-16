<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Entrust
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(Route::currentRouteName());
        if (!Auth::user()->hasPermission(Route::currentRouteName())) {
            return redirect()->back()->withErrors("没有操作权限");
        }

        return $next($request);
    }
}
