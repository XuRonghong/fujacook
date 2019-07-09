<?php

namespace App\Http\Controllers\Admin;

use App\Presenters\Admin\HomePresenter;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $presenter;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(HomePresenter $presenter)
    {
//        $this->middleware('auth');
        $this->presenter = $presenter;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->presenter->getParameters('index', ['route_url' => $this->route_url]);

        return view('admin.home', compact('data'));
    }
}




