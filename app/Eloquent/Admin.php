<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard_name = 'admin';

    //
//    protected $table = 'admins';
//    protected $primaryKey = 'id';
    protected $fillable = [
        'no',
        'rank',
        'type',
        'name',
        'email',
        'account',
        'password',
        'createIP',
        'active',
        'remember_token',
        'login_time'
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'account' => ($except=='account'?'nullable':'required'). ($noUnique?'':'|unique:admins'),
            'password' => 'required',
            'name' => 'required'. ($noUnique?'':'|unique:admins'),
        ];
        $messages = [
            'account.required' => '帳號為必填項目',
            'account.unique' => '帳號不能重複',
            'password.required' => '概要為必填項目',
            'name.required' => '名稱為必填項目',
            'name.unique' => '名稱不能重複',
        ];
        return $request->validate($rules, $messages);
    }

    public function info()
    {
        return $this->hasMany('App\AdminInfo','admin_id','id');
    }

    public function permission()
    {
        return $this->belongsToMany('App\Permission'/*,'admin_permission','admin_id','id'*/);
    }

    public function menu()
    {
        return $this->belongsToMany('App\Menu'/*,'admin_menu','admin_id','id'*/);
    }
}
