<?php

namespace App\Presenters\Admin;


class NewsPresenter extends Presenter
{
    protected $gotoUrl;
    protected $title;

    public function __construct()
    {
        $this->gotoUrl = route('admin.news.index');
        $this->title = 'News';
    }
}
