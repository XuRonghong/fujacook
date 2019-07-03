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


    public function withAdmin()
    {
        return $this->leftJoin('admins', function ($join){
            $join->on('admins.id', '=', 'user_id');
        })->select([
            $this->table.'.*',
            'admins.no',
            'admins.type',
            'admins.name',
        ]);
    }


    public function admin()
    {
        $this->belongsTo('App\Admin', 'user_id', 'id');
    }
}
