<?php

namespace App\Http\Middleware;

use Closure;

class CheckMallLogin
{
    public function __construct ()
    {
    }

    public function handle ( $request, Closure $next )
    {
        $rtndata = [];
        if ( !session()->has( 'shop_member' )) {
            if ($_SERVER ['REQUEST_METHOD'] == "POST") {
                $rtndata ['status'] = 0;
                $rtndata ['message'] = "請先登入";
                return response()->json( $rtndata );
            }

            session()->put( 'rtnurl', url( $_SERVER ['REQUEST_URI'] ) );
            return redirect()->guest( 'login' );
        }

        return $next ( $request );
    }
}
