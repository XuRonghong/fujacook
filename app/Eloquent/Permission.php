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
        'guard_name'
    ];

    public function validate($request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
//            'hashtag_name' => 'required|array',
        ];
        $messages = [
            'title.required' => 'name為必填項目',
            'summary.required' => '描述為必填項目',
//            'hashtag_name.required' => '標籤為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany(
            'App\Admin'
//            'admin_has_permissions',
//            'permission_id',
//            'id'
        );
    }
}
