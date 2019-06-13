<?php

namespace App\Presenters\Admin;


class NewsPresenter extends Presenter
{
    protected $gotoUrl;
    protected $title;

    public function __construct()
    {
        $this->gotoUrl = url()->current();
        $this->title = 'News';
    }
}
