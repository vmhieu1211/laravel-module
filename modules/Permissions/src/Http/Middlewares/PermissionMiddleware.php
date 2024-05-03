<?php
namespace modules\Permissions\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware 
{
    public function handle(Request $request,Closure $next)
    {
        return $next($request);
    }
}