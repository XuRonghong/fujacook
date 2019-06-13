<?php

namespace App\Http\Controllers\Admin;

use App\Presenters\Admin\NewsPresenter;
use App\Repositories\Admin\NewsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $view_group_name = 'news';
    protected $route_url;

    public function __construct(NewsRepository $repository, NewsPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;

        $this->route_url = $this->presenter->getRouteResource('admin.news');    //所有關於route::resource的位置
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //meta data
        $data = $this->presenter->getParameters('index');
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->view_group_name.'.index', compact('data'));
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        //
        if(request()->ajax())
        {
            return $this->repository->getDataTable($request);
        }
        return response()->json('no ajax data', 204);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = $this->presenter->getParameters('create');
        //
        $data['arr'] = [];
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->view_group_name.'.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $this->repository->validate($request);
        //
        $permissions = $this->repository->create($request->all());

        return $this->presenter->responseJson($permissions['errors'], 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->presenter->getParameters('show');
        //
        $data['arr'] = $this->repository->findOrFail($id);
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->view_group_name.'.create', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = $this->presenter->getParameters('edit');
        //
        $data['arr'] = $this->repository->findOrFail($id);
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->view_group_name.'.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->repository->validate($request);

        $permissions = $this->repository->update($request->all(), $id);

        return $this->presenter->responseJson($permissions['errors'], 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->repository->delete($id);

        return $this->presenter->responseJson( 0, 'destroy');
    }
}
