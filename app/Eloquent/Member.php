<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use Notifiable;

    //
    protected $fillable = [
        'no',
        'name',
        'email',
        'account',
        'password',
        'api_token',
        'avatar',
        'phone',
        'county',
        'district',
        'address',
        'bonus',
        'confirm_terms',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * Get the memberContacts for the member.
     */
    public function memberContacts()
    {
        return $this->hasMany('App\MemberContact');
    }

    /**
     * Get the orders for the member.
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }



    /**
     * Get the memberBonusLogs for the member.
     */
    public function memberBonusLogs()
    {
        return $this->hasMany('App\Models\MemberBonusLog');
    }

    /**
     * Get the notifications for the member.
     */
    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')
            ->withPivot('is_read')
            ->withTimestamps();
    }

    /**
     * Get the productCombinationReviews for the member.
     */
    public function productCombinationReviews()
    {
        return $this->hasMany('App\Models\productCombinationReview');
    }

    /**
     * Get the orderReviews for the member.
     */
    public function orderReviews()
    {
        return $this->hasMany('App\Models\OrderReview');
    }
}
