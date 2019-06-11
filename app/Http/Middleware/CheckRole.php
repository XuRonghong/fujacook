<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        
        $pass = auth()->user()->hasRole($role);
        
        if ($pass === true) {
            return $next($request);
        } else {
            return redirect('/admin')->withErrors(['permission' => '權限不足']);
        }
    }
}
