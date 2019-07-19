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
        if ( !session()->has('member')) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                return response()->json([
                    'status' => 0,
                    'message' => "請先登入",    //User not login
                ], 401);
            }

            session()->put('nextUrl', url($_SERVER['REQUEST_URI']));
            return redirect()->guest( 'login' );
        }

        return $next ( $request );
    }
}
