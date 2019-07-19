<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuperLogin
{
	public function handle($request, Closure $next)
    {
        if (session()->get('member.type', 0) != 1) {
            return redirect()->guest('admin/login');
        }
		return $next ( $request );
	}
}
