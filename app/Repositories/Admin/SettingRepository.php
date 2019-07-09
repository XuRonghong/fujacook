<?php

namespace App\Repositories\Admin;

use App\Repositories\Repository;
use App\Setting;

class SettingRepository extends Repository
{
    protected $model;

    public function __construct(Setting $model)
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
            $attributes = array_merge($attributes, [
                'author_id' => auth()->guard('admin')->user()->id,
                'open' => config('app.open_default', 1),
            ]);
            if (isset($attributes['content'])) {
                $attributes['content'] = json_encode($attributes['content'], JSON_UNESCAPED_UNICODE);
            }

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
            if (isset($attributes['content'])) {
                $attributes['content'] = json_encode($attributes['content'], JSON_UNESCAPED_UNICODE);
            }
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
        return parent::delete($id);
    }
}
