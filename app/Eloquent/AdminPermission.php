<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    //
    protected $table = 'admin_has_permissions';

    protected $fillable = [
        'permission_id',
        'admin_id',
    ];
}
