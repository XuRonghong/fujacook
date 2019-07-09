<?php

namespace App\Http\Controllers\Admin;

use App\Presenters\Admin\MenuPresenter;
use App\Repositories\Admin\MenuRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminMenuController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $route_url;

    public function __construct(MenuRepository $repository, MenuPresenter $presenter)
    {
        $this->repository = $repository;
        $this->repository->setModel_AdminMenu();    //設定指定model

        $this->presenter = $presenter;
        $this->presenter->setTitle('Admin_menu');
        $this->presenter->setViewName('menus.admin_menu');      //指定view的位置
        //所有關於route::resource的位置
        $this->route_url = $this->presenter->getRouteResource($this->presenter->setRouteName('admin.admin_menu'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //meta data
        $data = $this->presenter->getParameters('index', ['route_url' => $this->route_url]);

        return $this->presenter->responseJson($data, 'index');
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        //
        if(request()->ajax())
        {
            $data = $this->repository->getDataTable_alone($request, 'admin_id <> 1');

            $data = $this->presenter->eachOne_aaData_adminMenu($data);     //每一項目要做甚麼事,有需要在使用

            return $this->presenter->responseJson($data, 'ajax', 200);
        }
        return $this->presenter->responseJson(['messages'=>'no ajax data'], 'noajax', 204);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = $this->presenter->getParameters('create', ['route_url' => $this->route_url]);
        //
        $data['arr'] = [];

        return $this->presenter->responseJson($data, 'create');
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
        //
        $data = $this->presenter->getParameters('show', ['route_url' => $this->route_url]);
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);

        return $this->presenter->responseJson($data, 'create');
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
        $data = $this->presenter->getParameters('edit', ['route_url' => $this->route_url]);
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);

        return $this->presenter->responseJson($data, 'create');
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
        // 除特殊情況不驗證
        if ($request->get('doValidate', 1))$this->repository->validate($request, 1);

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
