<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'no',
        'rank',
        'type',
        'author_id',
        'store_id',
        'name',
        'price',
        'num',
        'code',
        'image',
        'file_id',
        'spec_note',
        'product_description',
        'service_description',
        'other_description',
        'status',
        'open',
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'name' => 'required'. ($noUnique?'':'|unique:products'),
//            'description' => 'required',
//            'guard_name' => 'required|array',
        ];
        $messages = [
            'name.required' => 'name為必填項目',
            'name.unique' => 'name不能重複',
//            'description.required' => '描述為必填項目',
//            'guard_name.required' => 'guard_name為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany('App\Admin'/*,'admin_permission','permission_id','id'*/);
    }
}
