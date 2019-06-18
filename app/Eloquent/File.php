<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rank',
        'author_id',
        'type',
        'file_type',
        'file_server',
        'file_path',
        'file_name',
        'file_size',
        'open',
    ];
}
