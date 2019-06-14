<?php

namespace App\Presenters\Admin;


class MenuPresenter extends Presenter
{
    protected $gotoUrl;
    protected $title;

    public function __construct()
    {
        $this->gotoUrl = route('admin.menu.index');
        $this->title = 'Menu';
    }
}
