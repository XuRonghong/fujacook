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

    public function Admin()
    {
        return $this->belongsToMany(
            'App\Eloquent\Admin',
            'admin_has_permissions',
            'admin_id',
            'id'
        );
    }
}
