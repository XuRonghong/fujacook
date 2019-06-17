<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAction extends Model
{
    //
    protected $table = 'log_actions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'user_type',
        'table_id',
        'table_name',
        'action',
        'value',
        'ip',
    ];
}
