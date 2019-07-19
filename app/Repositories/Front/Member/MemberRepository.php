<?php

namespace App\Repositories\Member;

use App\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Repositories\Repository;
use App\Repositories\ParameterRepository;

class MemberRepository extends Repository
{
    protected $model;
    protected $ParameterRepository;
    
    public function __construct(
        Member $model,
        ParameterRepository $parameterRepository
    ) {
        $this->model = $model;
        $this->parameterRepository = $parameterRepository;
    }
    
    public function membersFilter($query, $columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        $model = $query;
        
        if ($request) {
            $request = ($request instanceof Request) ? $request->all() : (is_array($request) ? $request : []);
            
            $model = parent::filter($request, $model, __NAMESPACE__ . '\Filters\Member\\');
    
            $sort = array_get($request, 'sort', 'updated_at|desc');
            $sort = explode("|", $sort);
            
            $orderBy = array_get($sort, '0', 'id');
            $dir     = array_get($sort, '1', 'asc');
            
            $model = $model->orderBy($orderBy, $dir);
        }
        
        return $this->getModelsByQuery($model, $columns, $paginate, $with);
    }
    
    public function getMembers($columns = ['*'], $request = null, $paginate = null, $with = null)
    {
        return $this->membersFilter($this->model, $columns, $request, $paginate, $with);
    }
    
    public function getMemberByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }
    
    public function whereEmail(string $email)
    {
        $this->model = $this->model->where('email', $email);
        return $this;
    }

    public function create($attributes)
    {
        if (array_has($attributes, 'password')) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $attributes['no'] = $this->getNextMembersNo();

        $model = parent::create($attributes);

        return $model;
    }

    public function firstOrCreate(array $attributes, array $values = [])
    {
        if (array_has($values, 'password')) {
            $values['password'] = bcrypt($values['password']);
        }
        $values['no'] = $this->getNextMembersNo();

        return $this->model->firstOrCreate($attributes, $values);
    }

    public function getNextMembersNo()
    {
        $last_members_no = $this->parameterRepository->getParametersByNameAndLock('last_members_no');
        $no = '100000001';

        if ($last_members_no->content != '') {
            $no = substr($last_members_no->content, 1, 9);
        }

        $last_members_no->content = 'M'.((int)$no+1);

        $last_members_no->save();
        
        return $last_members_no->content;
    }

    public function chunkMembers($columns = ['*'], $closure)
    {
        return $this->model
            ->chunk(100, $closure);
    }
}
