<?php

namespace App\Http\Controllers\Admin;

use App\Presenters\Admin\HomePresenter;
use App\Http\Controllers\Controller;

class IndexController extends Controller
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
        $data = $this->presenter->getParameters('index');

        $keyword = request()->get('k', 0);
        if ($keyword){
            foreach (config('parameter.global_keyword') as $key => $searchs) {
                if (strpos($searchs, $keyword)!==false) {
                    return redirect( route('admin.'.$key) );
                }
            }
        }

        return view('admin.index', compact('data'));
    }
}




