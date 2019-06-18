<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminInfo extends Model
{

    public $timestamps = false;     //取消自動時間戳記
    protected $table = 'admins_info';
    protected $primaryKey = 'admin_id';
    protected $fillable = [
        'admin_id',
        'user_image',
        'user_name',
        'user_name_en',
        'user_title',
        'userID',
        'user_birthday' ,
        'user_email',
        'user_contact',
        'user_zip_code',
        'user_city',
        'user_area',
        'user_address',
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

    public function admin()
    {
        return $this->belongsTo(
            'App\Admin',
            'admin_id',
            'id'
        );
    }
}
