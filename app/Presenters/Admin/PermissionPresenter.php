<?php

namespace App\Presenters\Admin;

class PermissionPresenter extends Presenter
{
    protected $gotoUrl;
    protected $title;

    public function __construct()
    {
        $this->gotoUrl = route('admin.permissions.index');
        $this->title = 'Permissions';
    }
}
