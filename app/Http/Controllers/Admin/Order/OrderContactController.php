<?php

namespace App\Http\Controllers\Admin\Order;

use App\Presenters\Admin\OrderPresenter;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class OrderContactController extends Controller
{
    protected $repository;
    protected $presenter;
    protected $route_url;

    public function __construct(OrderRepository $repository, OrderPresenter $presenter)
    {
        $this->repository = $repository;
        $this->repository->setModel_OrderContact();

        $this->presenter = $presenter;
        $this->presenter->setTitle(trans('menu.order.contact.title'));
        $this->presenter->setViewName('order.contact');
        $this->presenter->setSelectOpt( $this->repository->getORM_PaymentMethods() );

        //所有關於route::resource的位置
        $this->route_url = $this->presenter->getRouteResource($this->presenter->setRouteName('admin.order.contact'), 'cped');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //訂單內的詳情地址
        if (request()->get('o_no')) {

            $Order = $this->repository->getORM_Order(['id'], "no = '".request()->get('o_no', '?')."'");

            if ($Order) session()->put('order_id', array_first($Order)->id);
        }
        else session()->forget('order_id');

        //meta data
        $data = $this->presenter->getParameters('index', array('route_url' => $this->route_url));
        //edit breadcrumb for mass_destroy.
        $this->presenter->editParameters(
            $data,
            'breadcrumb',
            $this->presenter->presentBreadcrumb([
                trans('menu.order.product.title') => route('admin.order.product.index'),
                trans('menu.order.contact.title') => request()->getUri(),
            ])
        );
        // to btn-back.
        $this->presenter->addParameters($data, 'backUrl', route('admin.order.product.index'));

        return $this->presenter->responseJson($data, 'index');
    }

    /* ajax datatable */
    public function list(Request $request)
    {
        if (session()->get('order_id')) $this->repository->setWhereQuery('order_id', session()->get('order_id'));
        //
        if(request()->ajax())
        {
            $data = $this->repository->getDataTable($request);

            $data = $this->presenter->eachOne_aaData($data, 'order_contacts');     //每一項目要做甚麼事,有需要在使用

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
        $data['arr'] = $this->presenter->transOne($data['arr'],  $this->repository->getModel());

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
    }
}
