<?php

namespace Modules\Client\src\Middlewares;

use Closure;
use Illuminate\Http\Request;

class ClientMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
