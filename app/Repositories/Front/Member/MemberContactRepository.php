<?php

namespace App\Repositories\Member;

use App\Models\MemberContact;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class MemberContactRepository extends Repository
{
    /**
     * @var \App\Models\MemberContact
     */
    protected $model;
    
    public function __construct(MemberContact $model)
    {
        $this->model = $model;
    }
    
    public function memberContactFilter($query, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $model = $query;
        
        if ($request) {
            $request = ($request instanceof Request) ? $request->all() : (is_array($request) ? $request : []);
            
            $model = parent::filter($request, $model, __NAMESPACE__ . '\Filters\Contact\\');
            
            $sort = array_get($request, 'sort', 'id|asc');
            $sort = explode("|", $sort);
            
            $orderBy = array_get($sort, '0', 'id');
            $dir     = array_get($sort, '1', 'asc');
            
            $model = $model->orderBy($orderBy, $dir);
        }
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
    
    public function getMemberContact($id, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $model = $this->model->where('member_id', $id);
        
        return $this->memberContactFilter($model, $columns, $request, $paginate, $with);
    }
}