<?php

namespace App\Repositories\Order;


use App\Models\Order;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class OrderRepository extends Repository
{
    /**
     * @var \App\Models\Order
     */
    protected $model;
    
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
    
    public function getOrders($columns = ['*'], Request $request = null, $paginate = null, $with = null)
    {
        $model = $this->model;
        
        if ($request) {
            $model = parent::filter($request->all(), $model, __NAMESPACE__ . '\Filters\Orders\\');
            
            $sort = $request->get('sort', 'id|asc');
            $sort = explode("|", $sort);
            
            $orderBy = array_get($sort, '0', 'id');
            $dir     = array_get($sort, '1', 'asc');
            
            $model = $model->orderBy($orderBy, $dir);
        }
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
    
    public function getOrdersByMember(
        $member_id,
        $columns = ['*'],
        $request = null,
        $paginate = null,
        $with = null
    ) {
        $model = $this->model;
        $model = $model->where('member_id', $member_id);
        
        if ($request) {
            $request = ($request instanceof Request) ? $request->all() : (is_array($request) ? $request : []);
            
            $model = parent::filter($request, $model, __NAMESPACE__ . '\Filters\ByMember\\');
            
            $model = $model->orderBy('id', 'desc');
        }
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
    
    public function getOrdersById(
        $id,
        $with = null
    ) {
        $model = $this->model;
        $model = $model->where('id', $id);
        
        return $this->getModelsByQuery($model, ['*'], null, $with);
    }

    public function getOrderByNo(
        $userId,
        $no
    ) {
        $query = $this->model
            ->where('member_id', $userId)
            ->where('no', $no)
            ->first();
        return $query;
    }
}