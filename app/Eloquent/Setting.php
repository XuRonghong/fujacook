<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'author_id',
        'rank',
        'category',
        'type',
        'name',
        'content',
        'value',
        'count',
        'lang',
        'url',
        'sylte',
        'image',
        'open',
    ];

    public function validate($request, $noUnique=0)
    {
        $rules = [
            'name' => 'required'. ($noUnique?'':'|unique:settings'),
            'content' => 'required',
            'value' => 'required',
        ];
        $messages = [
            'name.required' => '參數名稱為必填項目',
            'name.unique' => '參數名稱不能重複',
            'content.required' => '參數內容為必填項目',
            'value.required' => '有必填項目',
        ];
        return $request->validate($rules, $messages);
    }
}
