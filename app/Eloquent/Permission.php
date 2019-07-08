<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'guard_name',
    ];

    public function validate($request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
//            'guard_name' => 'required|array',
        ];
        $messages = [
            'name.required' => 'name為必填項目',
            'description.required' => '描述為必填項目',
//            'guard_name.required' => 'guard_name為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany('App\Admin'/*,'admin_permission','permission_id','id'*/);
    }
}
