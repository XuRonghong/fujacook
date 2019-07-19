<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogout
{
    public function handle ( $request, Closure $next )
    {
        if ( session()->has('member')) {
            return redirect()->guest('logout');
        }

        return $next ( $request );
    }
}
