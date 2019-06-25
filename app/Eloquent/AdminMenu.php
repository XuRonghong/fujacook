<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    //
    protected $table = 'admin_menu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'admin_id',
        'menu_id',
    ];

    public function validate($request)
    {
        $rules = [
            'admin_id' => 'required',
            'menu_id' => 'required',
        ];
        $messages = [
            'admin_id.required' => 'admin_id為必填項目',
            'menu_id.required' => 'menu_id為必填項目',
        ];
        return $request->validate($rules, $messages);
    }
}
