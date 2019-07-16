<?php

namespace App\Repositories\Admin;

use App\AdminMenu;
use App\Menu;
use App\Repositories\Repository;

class MenuRepository extends Repository
{
    protected $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function setModel_AdminMenu()
    {
        $this->model = new AdminMenu;
    }

    public function all($attributes='')
    {
        return $this->model::all();
    }

    public function create($attributes)
    {
        try{
            $attributes = array_merge($attributes, [
                'author_id' => auth()->guard('admin')->user()->id,
//                'open' => config('app.open_default', 1),
            ]);

            return parent::create($attributes); // TODO: Change the autogenerated stub
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
            $attributes = array_merge($attributes, [
                'author_id' => auth()->guard('admin')->user()->id,
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
                $join->on('admins.id', '=', 'admin_menu.admin_id')
                    ->select(['name','type']);
            })
            ->join('menus', function($join) {
                $join->on('menus.id', '=', 'admin_menu.menu_id')
                    ->select(['name','link']);
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
                $join->on('admins.id', '=', 'admin_menu.admin_id')
                    ->select(['name','type']);
            })
            ->join('menus', function($join) {
                $join->on('menus.id', '=', 'admin_menu.menu_id')
                    ->select(['name','link']);
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
                'admin_menu.*',
                'menus.link'
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

}
