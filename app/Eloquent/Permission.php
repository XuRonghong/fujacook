<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = 'permissions';

    //
    protected $fillable = [
        'name',
        'description',
        'guard_name'
    ];

    public function admin()
    {
        return $this->belongsToMany(
            'App\Admin',
            'admin_has_permissions',
            'permission_id',
            'id'
        );
    }
}
