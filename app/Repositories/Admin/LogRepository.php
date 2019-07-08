<?php

namespace App\Repositories\Admin;

use App\LogAction;
use App\LogLogin;
use App\Repositories\Repository;


class LogRepository extends Repository
{
    protected $model;

    public function __construct(LogLogin $model)
    {
        $this->model = $model;
    }

    public function setModel_LogAction()
    {
        $this->model = new LogAction();
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

    public function findOrFail($id)
    {
        return $this->model->withAdmin()->findOrFail($id);
    }
}
