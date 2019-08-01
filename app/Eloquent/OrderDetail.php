<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    protected $table = 'order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no',
        'order_id',
        'product_id',
        'ownerKey',
        'related',
        'type',
        'purchase_price',
        'cost_price',
        'price',
        'market_price',
        'quantity',
        'status',
    ];
    
    /**
     * Get the order that owns the OrderDetail.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function productSpec()
    {
        return $this->belongsTo('App\ProductSpec', 'ownerKey', 'id');
    }
    
    /**
     * Get the productItem that owns the OrderDetail.
     */
    public function productItem()
    {
        return $this->belongsTo('App\ProductItem', 'ownerKey', 'id');
    }
    
    /**
     * Get the productCombination that owns the OrderDetail.
     */
    public function productCombination()
    {
        return $this->belongsTo('App\ProductCombination', 'ownerKey', 'id')->withTrashed();
    }
}
