<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\News\NewsService;
use App\Presenters\Admin\NewsPresenter;

class NewsController extends Controller
{
    protected $service;
    protected $presenter;

    public function __construct(NewsService $service, NewsPresenter $presenter)
    {
        $this->service = $service;
        $this->presenter = $presenter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = $this->service->NewRepository()->all();
        //meta data
        $data = $this->presenter->getParameters('index');
        //to ajax url
        $route_url = $this->presenter->getRouteResource('admin.news');

        return view('admin.news.index', compact('data','news', 'route_url'));
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        //
        if(request()->ajax())
        {
            return $this->service->NewRepository()->getDataTable($request);
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
        $news = [];

        return view('admin.news.create', compact('data', 'news'));
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
        $data = $this->service->validate($request);
        //
        $news = $this->service->NewRepository()->create($request->all());

        return $this->presenter->responseJson($news['errors'], 'store');
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
        $news = $this->service->NewRepository()->findOrFail($id);

        return view('admin.news.create', compact('data','news'));
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
        $news = $this->service->NewRepository()->findOrFail($id);

        return view('admin.news.create', compact('data','news'));
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
        $this->service->validate($request);

        $news = $this->service->NewRepository()->update($request->all(), $id);

        return $this->presenter->responseJson($news['errors'], 'update');
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
        $this->service->NewRepository()->delete($id);

        return $this->presenter->responseJson( 0, 'destroy');
    }
}
