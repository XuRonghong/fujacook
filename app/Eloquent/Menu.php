<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'parent_id',
        'rank',
        'type',
        'name',
        'link',
        'sub_menu',
        'access',
        'open',
    ];
}
