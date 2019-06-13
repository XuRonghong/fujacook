<?php

namespace App\Repositories\Admin;

use App\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function all($attributes='')
    {
        return $this->model::all();
    }

    public function create($attributes)
    {
        try{
            return parent::create($attributes); // TODO: Change the autogenerated stub
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
            return parent::update($attributes, $id);
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function delete($id)
    {
        return parent::delete($id);
    }



    /*
     * 既有的一些方法
     */
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