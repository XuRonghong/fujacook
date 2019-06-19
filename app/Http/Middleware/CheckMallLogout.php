<?php

namespace App\Http\Middleware;

use Closure;

class CheckMallLogout
{
    public function __construct ()
    {
    }

    public function handle ( $request, Closure $next )
    {
        if ( session()->has( 'shop_member' )) {
            return redirect()->guest( 'logout' );
        }

        return $next ( $request );
    }
}
