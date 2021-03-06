<?php

namespace App\Repositories\Admin;

use App\AdminPermission;
use App\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{
    protected $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function setModel_AdminPermission()
    {
        $this->model = new AdminPermission();
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
            $attributes = array_merge($attributes, [
//                'author_id' => auth()->guard('admin')->user()->id,
            ]);
            // 啟用 或 不啟用
            if (isset($attributes['open']) && isset($attributes['doValidate'])) {
                $admin_menu = $this->model->find($id);
                $attributes['open'] = ($attributes['open'] == "change") ? !$admin_menu->open : $admin_menu->open;
            }

            return parent::update($attributes, $id);
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try{
            return parent::delete($id);
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }


    /*
     * 自己獨立做一個 data table
     */
    public function getDataTable_alone($request, $whereQuery='1 = 1')
    {
        //
        $sort_arr = [];
        $search_arr = [];   //要搜尋的目標欄位名稱
        $search_word = $request->input('sSearch', '');
        $iDisplayLength = $request->input('iDisplayLength', 10);
        $iDisplayStart = $request->input('iDisplayStart', 0);
        $sEcho = $request->input('sEcho', '');
        $column_arr = explode(',', $request->input('sColumns', ''));
        foreach ($column_arr as $key => $item)
        {
            if ($item == "") {
                unset( $column_arr[$key] );
                continue;
            }
            if ($request->input( 'bSearchable_' . $key ) == "true") {
                $search_arr[$key] = $item;
            }
            if ($request->input( 'bSortable_' . $key ) == "true") {
                $sort_arr[$key] = $item;
            }
        }
        $sort_name = $sort_arr[ $request->input( 'iSortCol_0' ) ];
        $sort_dir = $request->input( 'sSortDir_0' );


        $total_count = $this->model
            ->join('admins', function($join) {
                $join->on('admins.id', '=', 'admin_permission.admin_id')
                    ->select(['name','type']);
            })
            ->join('permissions', function($join) {
                $join->on('permissions.id', '=', 'admin_permission.permission_id')
                    ->select(['name','description']);
            })
            ->where(function( $query ) use ( $search_arr, $search_word ) {
                foreach ($search_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
//            ->where(function ($query) use ($orderStartDate, $orderEndDate, $orderPayStatus, $orderStatus) {
//                if ($orderStartDate && $orderEndDate) {
//                    $query->whereBetween('mod_order.iCreateTime', [$orderStartDate, $orderEndDate + 86400]);
//                }
//                if ($orderPayStatus != "") {
//                    $query->where('mod_order.iPayStatus', $orderPayStatus);
//                }
//                if ($orderStatus != "") {
//                    $query->where('mod_order.iStatus', $orderStatus);
//                }
//            })
            ->whereRaw($whereQuery)
            ->count();


        $data_arr = $this->model
            ->join('admins', function($join) {
                $join->on('admins.id', '=', 'admin_permission.admin_id')
                    ->select(['name','type']);
            })
            ->join('permissions', function($join) {
                $join->on('permissions.id', '=', 'admin_permission.permission_id')
                    ->select(['name','description']);
            })
            ->where(function( $query ) use ( $search_arr, $search_word ) {
                foreach ($search_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
//            ->where(function ($query) use ($orderStartDate, $orderEndDate, $orderPayStatus, $orderStatus) {
//                if ($orderStartDate && $orderEndDate) {
//                    $query->whereBetween('mod_order.iCreateTime', [$orderStartDate, $orderEndDate + 86400]);
//                }
//                if ($orderPayStatus != "") {
//                    $query->where('mod_order.iPayStatus', $orderPayStatus);
//                }
//                if ($orderStatus != "") {
//                    $query->where('mod_order.iStatus', $orderStatus);
//                }
//            })
            ->whereRaw($whereQuery)
            ->select([
                'admins.name',
                'admins.type',
                'admin_permission.*',
                'permissions.description'
            ])
            ->orderBy( $sort_name, $sort_dir )
            ->offset($iDisplayStart)->limit($iDisplayLength)
            ->get();

        if ( !$data_arr) {
            return response()->json([
                'status'=> 0,
                'message'=> ['Oops! 沒有資料!']
            ],204);
        } else {
            foreach ($data_arr as $key => $data) {
                $data->DT_RowId = $data->id;
            }
        };

        return [
            'status'=> 1,
            'message'=> sprintf("已得到 %s", $total_count."筆資料"),
            'sEcho'=> $sEcho,
            'iTotalDisplayRecords'=>$total_count,
            'iTotalRecords'=>$total_count,
            'aaData'=> $total_count ? $data_arr : []
        ];
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
