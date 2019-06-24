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

//    public function validate($request)
//    {
//        $rules = [
//            'title' => 'required',
//            'summary' => 'required',
//            'hashtag_name' => 'required|array',
//            'startTime' => 'nullable',
//            'endTime' => 'nullable',
//            'open' => 'nullable'
//        ];
//        $messages = [
//            'title.required' => '標題為必填項目',
//            'summary.required' => '概要為必填項目',
//            'category_id.required' => '商品分類為必填項目',
//            'hashtag_name.required' => '標籤為必填項目',
//        ];
//        return $request->validate($rules, $messages);
//    }

    public function info()
    {
        return $this->hasMany(
            'App\AdminInfo',
            'admin_id',
            'id'
        );
    }

    public function permission()
    {
        return $this->belongsToMany(
            'App\Permission'
//            'admin_permission',
//            'admin_id',
//            'id'
        );
    }
}
