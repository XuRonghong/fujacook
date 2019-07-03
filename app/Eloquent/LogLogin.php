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
