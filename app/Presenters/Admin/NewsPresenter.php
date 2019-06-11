<?php

namespace App\Presenters\Admin;


class NewsPresenter extends Presenter
{
    protected $indexUrl;
    protected $title;

    public function __construct()
    {
        $this->indexUrl = route('admin.news.index');
        $this->title = 'News';
    }
}
