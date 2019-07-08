<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_id',
        'rank',
        'type',
        'name',
        'link',
        'sub_menu',
        'access',
        'open',
    ];

    public function validate($request)
    {
        $rules = [
//            'parent_id' => 'required',
//            'rank' => 'required',
//            'type' => 'nullable',
            'name' => 'required',
            'link' => 'required',
//            'sub_menu' => 'nullable',
//            'access' => 'nullable',
//            'open' => 'nullable'
        ];
        $messages = [
//            'parent_id.required' => '父id為必填項目',
//            'rank.required' => '為必填項目',
//            'type.required' => '為必填項目',
            'name.required' => '名稱為必填項目',
            'link.required' => 'link為必填項目',
//            'sub_menu.required' => '為必填項目',
//            'access.required' => '為必填項目',
//            'open.required' => '為必填項目'
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany('App\Admin'/*,'admin_menu','menu_id','id'*/);
    }
}
