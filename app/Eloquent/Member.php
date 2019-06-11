<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

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


    public function memberContacts()
    {
        return $this->hasMany('App\Eloquent\MemberContact');
    }
}
