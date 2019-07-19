<?php

namespace App\Repositories\Member;

use App\Models\MemberProvider;
use App\Repositories\Repository;

class MemberProviderRepository extends Repository
{
    protected $model;

    public function __construct(MemberProvider $model)
    {
        $this->model = $model;
    }

    public function whereProvider($provider)
    {
        $query = $this->model->where('provider',$provider);
        return $query;
    }

    public function whereToken($token)
    {
        $query = $this->model->where('token',$token);
        return $query;
    }

    public function getSocialiteByFacebookId($facebook_id)
    {
        $query = $this->model
            ->whereProvider('facebook')
            ->where('uid', $facebook_id)
            ->first();
        return $query;
    }
}
