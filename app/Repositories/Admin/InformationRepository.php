<?php

namespace App\Repositories\Admin;

use App\Information;
use App\News;
use App\Repositories\Repository;


class InformationRepository extends Repository
{
    protected $model;

    public function __construct(Information $model)
    {
        $this->model = $model;
    }

    public function setModel_News()
    {
        $this->model = new News;
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
                $news = $this->model->find($id);
                $attributes['open'] = ($attributes['open']=="change")? !$news->open : $news->open;
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

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}