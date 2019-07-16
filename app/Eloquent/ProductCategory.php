<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    //
    protected $table = 'product_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_id',
        'rank',
        'type',
        'author_id',
        'store_id',
        'name',
        'value',
        'number',
        'image',
        'file_id',
        'status',
        'open',
    ];

    public function validate($request, $noUnique=0)
    {
        $rules = [
            'name' => 'required'. ($noUnique?'':'|unique:product_categories'),
        ];
        $messages = [
            'name.required' => 'name為必填項目',
            'name.unique' => 'name不能重複',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsToMany('App\Admin'/*,'admin_permission','permission_id','id'*/);
    }
}
