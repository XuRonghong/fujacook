<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $table = 'coupons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'type',
        'code',
        'discount_percentage',
        'limit',
        'discount_price',
        'is_limit',
        'is_time_limit',
        'status',
        'start_at',
        'end_at',
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'code' => ($except=='code'?'nullable':'required'). ($noUnique?'':'|unique:'.$this->table),
        ];
        $messages = [
            'code.required' => 'name為必填項目',
            'code.unique' => 'name不能重複',
        ];
        return $request->validate($rules, $messages);
    }

    /**
     * Get all of the owning bannerable models.
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
