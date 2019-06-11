<?php

namespace App\Presenters\Admin;


class HomePresenter extends Presenter
{
    protected $gotoUrl;
    protected $title;

    public function __construct()
    {
        $this->gotoUrl = url('admin');
        $this->title = 'Shoppin2 admin';
    }
}
