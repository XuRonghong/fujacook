<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\PermissionRepository;

class CheckPermission
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

        $user = auth()->user();
        if ($name) {
            $can = $user->can($name);
        } else {
            $can = $user->can($request->route()->getName());

            $route_name = $request->route()->getName();

            $permission = $this->permissionRepository->getPermissionByRouteName($route_name);

            if (empty($permission)) {
                return $next($request);
            }
        }

        if ($can === true) {
            return $next($request);
        } else {
            return redirect('/admin')->withErrors(['permission' => '權限不足']);
        }

    }
}
