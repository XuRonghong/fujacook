<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCombination extends Model
{
    //
    protected $table = 'product_combinations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'no',
        'rank',
        'type',
        'author_id',
        'name',
        'image',
        'file_id',
        'detail',
        'stars',
        'review_count',
        'purchased_count',
        'price',
        'market_price',
        'open',
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'name' => ($except=='name'?'nullable':'required'). ($noUnique?'':'|unique:'.$this->table),
            'product_id' => 'required',
        ];
        $messages = [
            'name.required' => '組合商品別名 為必填項目',
            'name.unique' => '組合商品別名 不能重複',
            'product_id.required' => '商品為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin','author_id','id');
    }
}
