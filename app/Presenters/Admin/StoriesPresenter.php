<?php

namespace App\Presenters;


class StoriesPresenter extends Presenter
{
    protected $indexUrl;
    protected $title;

    public function __construct()
    {
        $this->indexUrl = route('admin.store.index');
        $this->title = 'Stories';
    }
}
