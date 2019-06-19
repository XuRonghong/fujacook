<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperLogin
{
	public function __construct()
    {
	}

	public function handle($request, Closure $next)
    {
		if (! session ()->has ( 'member' )) {
			return redirect ()->guest ( 'web/login' );
		}
        if (session ()->get ( 'member.iAcType' )!=1) {
            return redirect ()->guest ( 'web/login' );
        }
		return $next ( $request );
	}
}
