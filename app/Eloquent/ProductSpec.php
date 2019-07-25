<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    //
    protected $table = 'product_specs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'spec_num',     //型號
        'name',     //規格名稱
        'spec_unit',    //單位
        'spec_price',   //規格價格
        'spec_stock',   //規格庫存
        'spec_safe_stock',  //安全庫存
        'image',        //單一圖片
        'file_id',      //多圖片
        'status',       //多狀態
        'open',     //開放
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'name' => ($except=='name'?'nullable':'required'). ($noUnique?'':'|unique:'.$this->table),
            'spec_num' => 'required',
            'spec_price' => 'required',
            'spec_stock' => 'required',
            'spec_safe_stock' => 'required',
        ];
        $messages = [
            'name.required' => '規格名稱為必填項目',
//            'name.unique' => '規格名稱不能重複',
            'spec_num.required' => '型號為必填項目',
            'spec_price.required' => '規格價格為必填項目',
            'spec_stock.required' => '規格庫存為必填項目',
            'spec_safe_stock.required' => '安全庫存為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function product()
    {
        return $this->belongsTo('App\Product','id','product_id');
    }
}
