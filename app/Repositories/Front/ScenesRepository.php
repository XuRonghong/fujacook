<?php

namespace App\Repositories\Front;

use App\Repositories\Repository;
use App\Scene;


class ScenesRepository extends Repository
{
    protected $model;

    public function __construct(Scene $model)
    {
        $this->model = $model;
    }

    public function getOrmByType($type = 0, $whereQuery='1 = 1')
    {
        return $type? $this->model::query()->where('open', 1)
            ->where('type','LIKE', $type)
            ->whereRaw($whereQuery)
            ->orderBy('rank', 'asc')
            ->get() : null;
    }

    public function all($attributes='')
    {
        return $this->model::all();
    }

    public function create($attributes)
    {
        try{
//            $attributes = array_merge($attributes, [
//
//            ]);
            return parent::create($attributes); // TODO: Change the autogenerated stub
        } catch (\Exception $e){
            return ['errors'=> $e->getMessage()];
        }
    }

    public function update($attributes, $id)
    {
        try{
//            $attributes = array_merge($attributes, [
//
//            ]);
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
