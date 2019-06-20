<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    public $timestamps = false;
    protected $table = 'user_verification';
    protected $primaryKey = 'id';
}
