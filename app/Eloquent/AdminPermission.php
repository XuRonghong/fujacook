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
        'open',
    ];

    public function validate($request)
    {
        $rules = [
            'admin_id' => 'required',
            'permission_id' => 'required',
        ];
        $messages = [
            'admin_id.required' => 'admin id為必填項目',
            'permission_id.required' => 'permission id為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function permission()
    {
        return $this->belongsTo('App\Permission', 'permission_id', 'id');
    }
}
