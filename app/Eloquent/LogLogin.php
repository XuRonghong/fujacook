<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogLogin extends Model
{
    //
    protected $table = 'log_logins';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'user_type',
        'action',
        'ip',
    ];
}
