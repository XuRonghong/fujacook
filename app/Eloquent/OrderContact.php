<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderContact extends Model
{

    protected $table = 'order_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'type',
        'name',
        'gender',
        'email',
        'phone',
        'zip_code',
        'county',
        'district',
        'address',
        'tax_ID',
        'remarks',
    ];

    /**
     * Get the order that owns the OrderContact.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
