<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Presenters\Admin\SettingPresenter;
use App\Repositories\Admin\SettingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeywordController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $route_url;

    public function __construct(SettingRepository $repository, SettingPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;
        //指定view的位置
        $this->presenter->setTitle(trans('menu.setting.search_keywords.title'));
        $this->presenter->setViewName('setting.search_keywords');
        //所有關於route::resource的位置
        $this->route_url = $this->presenter->getRouteResource($this->presenter->setRouteName('admin.setting.search_keywords'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //meta data
        $data = $this->presenter->getParameters('index', array('route_url' => $this->route_url));

        return $this->presenter->responseJson($data, 'index');
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        //
        if(request()->ajax())
        {
            $data = $this->repository->getDataTable($request, "type LIKE 'search_keyword'");

            $data = $this->presenter->eachOne_aaData($data, 'search_keyword');     //每一項目要做甚麼事,有需要在使用

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
        $data = $this->presenter->getParameters('create', array('route_url' => $this->route_url));
        //get option for select
        $data['arr']['options'] = $this->presenter->getSelectOption('search_keyword');

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

        return $this->presenter->responseJson($data, 'store');
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
        $data = $this->presenter->getParameters('show', array('route_url' => $this->route_url));
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);
        //轉換出顯示數據
        $data['arr'] = $this->presenter->transOne($data['arr'], 'search_keyword');

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
        $data = $this->presenter->getParameters('edit', array('route_url' => $this->route_url));
        //若資料庫沒有該id 則404畫面
        $data['arr'] = $this->repository->findOrFail($id) or abort(404);
        //轉換出顯示數據
        $data['arr'] = $this->presenter->transOne($data['arr'], 'search_keyword');

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
        if ($request->get('doValidate', 1)) $this->repository->validate($request, 1);

        $data = $this->repository->update($request->all(), $id);

        return $this->presenter->responseJson($data, 'update');
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
        $data = $this->repository->delete($id);

        return $this->presenter->responseJson($data, 'destroy');
    }
}
