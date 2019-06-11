<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberContact extends Model
{
    //
    protected $fillable = [
        'no',
        'name',
        'email',
        'account',
        'password',
        'api_token',
        'avatar',
        'phone',
        'county',
        'district',
        'address',
        'bonus',
        'confirm_terms',
    ];


    public function member()
    {
        return $this->belongsTo('App\Eloquent\Member');
    }
}
