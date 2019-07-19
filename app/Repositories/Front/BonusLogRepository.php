<?php

namespace App\Repositories\Bonus;

use App\Models\MemberBonusLog;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class BonusLogRepository extends Repository
{
    /**
     * @var \App\Models\MemberBonusLog
     */
    protected $model;
    
    public function __construct(MemberBonusLog $model)
    {
        $this->model = $model;
    }
    
    public function getBonusByMember(
        $member_id,
        $columns = ['*'],
        $request = null,
        $paginate = null,
        $with = null
    ) {
        $model = $this->model;
        $model = $model->where('member_id', $member_id);
        
        if ($request) {
            
            $request = ($request instanceof Request) ? $request->all() : $request;
            
            $model = parent::filter($request, $model, __NAMESPACE__ . '\Filters\\');
            
            $model = $model->orderBy('id', 'desc');
        }
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
}