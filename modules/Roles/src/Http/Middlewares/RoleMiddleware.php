<?php

namespace modules\Roles\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
