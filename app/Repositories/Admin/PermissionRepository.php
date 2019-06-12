<?php

namespace App\Repositories\Admin;

use App\Permission;

class PermissionRepository extends Repository
{

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getPermissionsShare(&$query, $columns = ['*'], $request = null, $paginate = null)
    {
        $model = $query;

        if($request)
        {
            if ($request->get('shipment_id')) {
                $model = $model->where('shipment_id', $request->get('shipment_id'));
            }
            $model = $model->orderBy($request->get('sort', 'id'), $request->get('dir', 'asc'));
        }

        if($paginate) return $model->paginate($paginate, $columns);

        return $model->get($columns);
    }

    public function getPermissions($columns = ['*'], $request = null, $paginate = null)
    {
        $query = $this->model;
        
        return $this->getPermissionsShare($query, $columns, $request, $paginate);
    }

    public function getPermissionByRouteName($route_name)
    {
        return $this->model
            ->where('name', $route_name)
            ->first();
    }

}
