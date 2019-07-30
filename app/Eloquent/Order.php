<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no',
        'type',
        'store_id',
        'member_id',
        'total_price',
        'shipping_fee',
        'promo_fee',
        'bonus',
        'payment_method_id',
        'bank_last_no',
        'shipping_type',
        'shipping_status',
        'pay_status',
        'paid_at',
        'shipping_note',
        'pay_note',
        'customerservice_note',
        'status',
    ];

    public function validate($request, $noUnique=0, $except='')
    {
        $rules = [
            'member_id' => ($except=='member_id'?'nullable':'required'). ($noUnique?'':'|unique:'.$this->table),
        ];
        $messages = [
            'member_id.required' => '會員請登入',
//            'member_id.unique' => 'member_id不能重複',
        ];
        return $request->validate($rules, $messages);
    }
    
    /**
     * Get all of the owning bannerable models.
     */
    public function coupons()
    {
        return $this->belongsToMany('App\Coupon')->withTimestamps();
    }
    
    /**
     * Get the member that owns the Order.
     */
    public function member()
    {
        return $this->belongsTo('App\Member');
    }



    /**
     * Get the memberBonusLogs for the order.
     */
    public function memberBonusLogs()
    {
        return $this->hasMany('App\Models\MemberBonusLog');
    }
    
    /**
     * Get the orderContacts for the order.
     */
    public function orderContacts()
    {
        return $this->hasMany('App\Models\OrderContact');
    }
    
    public function orderContactsByOrder()
    {
        return $this->hasMany('App\Models\OrderContact')->where('type', '=', 1);
    }
    
    public function orderContactsByDeliver()
    {
        return $this->hasMany('App\Models\OrderContact')->where('type', '=', 2);
    }
    
    /**
     * Get the orderDetails for the order.
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
    
    /**
     * Get the OrderReview for the order.
     */
    public function orderReview()
    {
        return $this->hasOne('App\Models\OrderReview');
    }
    
    /**
     * Get the paymentMethod that owns the Order.
     */
    public function paymentMethod()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_id', 'id');
    }
}
