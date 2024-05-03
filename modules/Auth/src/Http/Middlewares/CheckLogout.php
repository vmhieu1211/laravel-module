<?php

namespace Modules\Auth\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class CheckLogout
{

    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return $next($request);
    }
}
