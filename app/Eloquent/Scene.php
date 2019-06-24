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
//            'rank',
//            'category',
//            'type',
            'title' => 'required|unique:scenes',
            'summary' => 'required',
//            'detail',
//            'lang' => 'required',
            'file_id' => 'required',
//            'image',
//            'image_mobile',
//            'url',
//            'start_time',
//            'end_time',
//            'open',
        ];
        $messages = [
//            'rank',
//            'category',
//            'type',
            'title.required' => '標題為必填項目',
            'title.unique' => '標題不能重複',
            'summary.required' => '概要為必填項目',
//            'detail',
//            'lang' => 'required',
            'file_id.required' => '沒有圖片',
//            'image',
//            'image_mobile',
//            'url',
//            'start_time',
//            'end_time',
//            'open',
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
