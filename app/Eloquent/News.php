<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rank',
        'authorId',
        'categoryId',
        'title',
        'summary',
        'image',
        'url',
        'detail',
        'startTime',
        'endTime',
        'open'
    ];

    /*
     *
     */
    public function admin()
    {
        return $this->belongsTo(
            'App\Admin',
            'author_id',
            'id'
        );
    }
}
