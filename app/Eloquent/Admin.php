<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    //
    protected $guard_name = 'admin';

    protected $fillable = [
        'name',
        'email',
        'account',
        'password',
    ];

    public function permission()
    {
        return $this->belongsToMany(
            'App\Permission',
            'admin_has_permissions',
            'permission_id',
            'id'
        );
    }
}
