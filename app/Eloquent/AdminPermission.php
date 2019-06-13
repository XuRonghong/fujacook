<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    //
    protected $table = 'admin_permission';

    protected $fillable = [
        'admin_id',
        'permission_id',
    ];
}
