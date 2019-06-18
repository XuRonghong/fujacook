<?php

namespace App\Http\Controllers\Admin\Scenes;

use App\Http\Controllers\FuncController;
use App\Presenters\Admin\ScenesPresenter;
use App\Repositories\Admin\ScenesRepository;
use App\SysFiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $route_url;

    public function __construct(ScenesRepository $repository, ScenesPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;

        //
//        $this->presenter->setRouteName('admin.scenes.home');
        //所有關於route::resource的位置
        $this->route_url = $this->presenter->getRouteResource($this->presenter->setRouteName('admin.scenes.home'));
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

            if ( $data['aaData']) {
                foreach ($data['aaData'] as $key => $var) {
                    $var->Title = trans('menu.'. $var->name. '.title');

                    //圖片
                    $image_arr = [];
                    $tmp_arr = explode( ';', $var->image );
                    $tmp_arr = array_filter( $tmp_arr );
                    foreach ($tmp_arr as $item) {
                        $image_arr[$item] = FuncController::_getFilePathById( $item );
                    }
                    if ($tmp_arr){
                        $var->image = $image_arr;
                    } else {
                        $var->image = [];
                    }
                }
            }

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
        //
        $data['arr'] = $this->repository->findOrFail($id);
        //圖片
        $image_arr = [];
        $tmp_arr = explode( ';', $data['arr']->image );
        $tmp_arr = array_filter( $tmp_arr );
        foreach ($tmp_arr as $item) {
            $image_arr[$item] = FuncController::_getFilePathById( $item );
        }
        if ($tmp_arr){
            $data['arr']->image = $image_arr;
        } else {
            $data['arr']->image = [];
        }


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
//        $this->repository->validate($request);

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
