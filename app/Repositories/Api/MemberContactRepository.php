<?php

namespace App\Repositories\Api;

use App\Repositories\Member\MemberContactRepository as MemberContactRepoBase;
use Illuminate\Support\Facades\Auth;

class MemberContactRepository extends MemberContactRepoBase
{
    
    public function create($attributes)
    {
        $attributes['member_id'] = Auth::id();
        
        return $this->model->create($attributes);
    }
    
    public function delete($id)
    {
        return $this->getMemberContact(Auth::id())->where('id', $id)->first()->delete();
    }
    
}