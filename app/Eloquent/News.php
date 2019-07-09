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
            'rank' => 'nullable',
            'type' => 'nullable',
            'author_id' => 'nullable',
            'title' => 'required',
            'summary' => 'required',
            'image' => 'nullable',
            'file_id' => 'nullable',
            'url' => 'nullable',
            'detail' => 'required',
            'startTime' => 'nullable',
            'endTime' => 'nullable',
            'open' => 'nullable'
        ];
        $messages = [
            'rank' => '排名為必填項目',
            'type' => '類別為必填項目',
            'author_id' => '創建者為必填項目',
            'title.required' => '標題為必填項目',
            'summary.required' => '概要為必填項目',
            'image' => '圖片為必填項目',
            'file_id' => '檔案為必填項目',
            'url' => '連結為必填項目',
            'detail' => '內文為必填項目',
            'startTime' => '開始時間為必填項目',
            'endTime' => '結束時間為必填項目',
            'open' => '開關為必填項目'
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin','author_id','id');
    }
}
