<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth($guard)->check()) {
            return redirect()->guest('admin/login');
        }

        auth()->shouldUse($guard);

        return $next($request);
    }
}
