<?php

namespace App\Repositories\Admin;

use App\Repositories\Repository;
use App\Scene;


class ScenesRepository extends Repository
{
    protected $model;

    public function __construct(Scene $model)
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
                'rank' => 5,
            ]);
//            $attributes['detail'] = htmlspecialchars( data_get($attributes, 'detail') ?: '' );
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
                $scene = $this->model->find($id);
                $attributes['open'] = ($attributes['open'] == "change") ? !$scene->open : $scene->open;
            }
            //
            if (isset($attributes['detail']) /*&& isset($attributes['doValidate'])*/) {
                $attributes['detail'] = htmlspecialchars( $attributes['detail']);
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
}
