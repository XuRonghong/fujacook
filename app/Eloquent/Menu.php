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
            'title' => 'required',
            'summary' => 'required',
//            'hashtag_name' => 'required|array',
//            'startTime' => 'nullable',
//            'endTime' => 'nullable',
//            'open' => 'nullable'
        ];
        $messages = [
            'title.required' => '標題為必填項目',
            'summary.required' => '概要為必填項目',
//            'category_id.required' => '商品分類為必填項目',
//            'hashtag_name.required' => '標籤為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany(
            'App\Admin'
//            'admin_menu',
//            'menu_id',
//            'id'
        );
    }
}
