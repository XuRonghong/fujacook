<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rank',
        'type',
        'author_id',
        'title',
        'summary',
        'image',
        'file_id',
        'url',
        'detail',
        'startTime',
        'endTime',
        'open'
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
        return $this->belongsTo(
            'App\Admin',
            'author_id',
            'id'
        );
    }
}
