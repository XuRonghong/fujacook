<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

    protected $table = 'payment_methods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'status',
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'name' => ($except=='name'?'nullable':'required'). ($noUnique?'':'|unique:'.$this->table),
//            'status' => 'required',
        ];
        $messages = [
            'name.required' => 'name為必填項目',
            'name.unique' => 'name不能重複',
//            'status.required' => 'status為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    /**
     * Get the orders for the paymentMethod.
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'payment_method_id', 'id');
    }
}
