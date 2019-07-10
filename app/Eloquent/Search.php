<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //
    protected $table = 'searches';
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
//            'name' => 'required',
//            'content' => 'required',
            'value' => 'required'. ($noUnique?'':'|unique:searches'),
        ];
        $messages = [
//            'name.required' => '參數名稱為必填項目',
//            'content.required' => '參數內容為必填項目',
            'value.required' => 'value必填項目',
            'value.unique' => 'value有重複',
        ];
        return $request->validate($rules, $messages);
    }
}
