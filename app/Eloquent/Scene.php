<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    //
    protected $table = 'scenes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'author_id',
        'rank',
        'category',
        'type',
        'title',
        'summary',
        'detail',
        'lang',
        'file_id',
        'image',
        'image_mobile',
        'url',
        'start_time',
        'end_time',
        'open',
    ];

    public function validate($request)
    {
        $rules = [
//            'title' => 'required',
//            'summary' => 'required',
//            'hashtag_name' => 'required|array',
//            'startTime' => 'nullable',
//            'endTime' => 'nullable',
//            'open' => 'nullable'
        ];
        $messages = [
//            'title.required' => '標題為必填項目',
//            'summary.required' => '概要為必填項目',
//            'category_id.required' => '商品分類為必填項目',
//            'hashtag_name.required' => '標籤為必填項目',
        ];
        return $request->validate($rules, $messages);
    }
}
