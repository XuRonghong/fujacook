<?php

namespace App\Http\Middleware;

use App\Admin;
use Closure;
use Auth;
use App\Repositories\Admin\PermissionRepository;

class CheckAdminPermission
{
    public function __construct(PermissionRepository $permissionRepository) 
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $name = null)
    {
        $user = auth()->guard('admin')->user();
        if ($name) {
            $can = $user->can($name);
        } else {
            $map['id'] = $user->id;
            $admin = Admin::query()->where($map)
                ->whereHas('permission', function ($query) use ($request) {
                    $query->where('name', $request->route()->getName());
                    $query->where('admin_permission.open', 1);
                });

            $can = $admin->count() ? true : false;

            $route_name = $request->route()->getName();

            $permission = $this->permissionRepository->getPermissionByRouteName($route_name);

            if (empty($permission)) {
                return $next($request);
            }
        }

        if ($can === true) {
            return $next($request);
        } else {
            if(request()->ajax()) {
                return response()->json(['message' => '權限不足'], 422);
            } else {
                return redirect('/admin/home')->withErrors(['permission' => '權限不足']);
            }
        }

    }
}
