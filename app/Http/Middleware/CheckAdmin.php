<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;

class CheckAdmin
{
    public function __construct ()
    {
    }

    public function handle ( $request, Closure $next, $name = null)
    {
        $user = auth()->guard('admin')->user();
        if ( !$name) {
            return redirect('admin/home')->withErrors(['permission' => 'middleware錯誤，請聯絡系統管理員']);
//            return redirect('admin/login');
        } else {
            //使用者啟用/不起用關鍵
            $map['id'] = $user->id;
            $map['active'] = 1;
            $admin = Admin::query()->where($map);

            $can = $admin->count() ? true : false;
        }

        if ($can === true) {
            return $next($request);
        } else {
            if(request()->ajax()) {
                return response()->json(['message' => '您遭停權'], 422);
            } else {
                return redirect('admin/home')->withErrors(['permission' => '您遭停權']);
            }
        }

        /*
        if ( !in_array( session()->get( 'member.iAcType' ), config( '_config.admin_access' ) )) {
            return abort( 503 );
        }

        return $next ( $request );
        */
    }
}
