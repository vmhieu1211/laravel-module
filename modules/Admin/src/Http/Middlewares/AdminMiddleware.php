<?php
namespace Modules\Admin\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request,Closure $next)
    {
        return $next($request);
    }
}