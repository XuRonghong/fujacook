<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\FuncController;
use App\Presenters\Admin\HomePresenter;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $presenter;
    protected $funcontroller;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomePresenter $presenter, FuncController $func)
    {
//        $this->middleware('auth');
        $this->presenter = $presenter;
        $this->funcontroller = $func;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->presenter->getParameters('index');
        //全局搜尋
        $goto = $this->funcontroller->globalSearch( request()->get('k', 0));

        return $goto?:view('admin.index', compact('data'));
    }
}




