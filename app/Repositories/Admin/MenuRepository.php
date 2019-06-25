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
                'open' => 1,
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
     * data object or array forEach to do.
     */
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) {
                $var->Title = trans('menu.'. $var->name. '.title');
                //找圖片檔案
                //$var = $this->transFileIdtoImage($var);
            }
        }
        return $arr;
    }
}
