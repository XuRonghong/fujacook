<?php

namespace App\Http\Controllers\Admin;

use App\Presenters\Admin\PermissionPresenter;
use App\Repositories\Admin\PermissionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PermissionController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $route_url;

    public function __construct(PermissionRepository $repository, PermissionPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;

        //所有關於route::resource的位置
        $this->route_url = $this->presenter->getRouteResource($this->presenter->setRouteName('admin.permissions'));
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

        return view('admin.'.$this->presenter->getViewName().'.index', compact('data'));
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        //
        if(request()->ajax())
        {
            $data = $this->repository->getDataTable($request);

            return response()->json($data,200);
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

        return view('admin.'.$this->presenter->getViewName().'.create', compact('data'));
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
        $this->repository->validate($request);
        //
        $data = $this->repository->create($request->all());

        return $this->presenter->responseJson($data['errors'], 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->presenter->getParameters('show');
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->presenter->getViewName().'.create', compact('data'));
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
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);
        //to ajax url
        $data['route_url'] = $this->route_url;

        return view('admin.'.$this->presenter->getViewName().'.create', compact('data'));
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

        $data = $this->repository->update($request->all(), $id);

        return $this->presenter->responseJson($data['errors'], 'update');
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
