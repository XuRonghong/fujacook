<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Stories\StoriesService;
use App\Store;
use Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $route_url = [
            'index' => route('admin.store.index'),
            'list' => route('admin.store.list'),
            'create' => '',
            'store' => route('admin.store.store'),
            'edit'  => '',
            'update' => route('admin.store.update'),
            'destroy' => url('admin.store.index'),
            'show' => route('admin.store.index').'/',
        ];
        return view('admin.store.index', compact('route_url'));
    }


    public function list()
    {
        //
        if(request()->ajax())
        {
            return datatables()->of(Store::latest()->get())
                ->addColumn('action', function($data){
                    $button = '';
//                    $button .= '<button class="btn btn-xs btn-default btn-show" title="全部資訊"><i class="fa fa-book" aria-hidden="true"></i></button>';
//                    $button .= '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
//                    $button .= '<button class="pull-right btn btn-xs btn-danger btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="show" id="'.$data->id.'" class="show btn btn-default btn-sm">Show</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
        $rules = array(
//            'name'    =>  'required',
            'name'   => 'required|unique:stores',
            'number'     =>  'required',
            'address'     =>  'required',
            'image'         =>  'required|image|max:2048'
        );

        $messages = [
            'name.required' => '標題為必填項目',
            'name.unique' => '路徑名稱已被使用',
            'number.required' => '內文為必填項目',
            'address.required' => '封面圖(方形)為必填項目',
            'image.*.path.required' => '封面圖(方形)為必填項目'
        ];

        $error = Validator::make( $request->all(), $rules, $messages );
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('image');

        $new_name = $request->name . rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);

        $form_data = array(
            'name'        =>  $request->name,
            'number'         =>  $request->number,
            'address'         =>  $request->address,
            'image'             =>  $new_name
        );

        Store::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
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
        if(request()->ajax())
        {
            $data = Store::findOrFail($id);
            return response()->json(['data' => $data]);
        }
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
        if(request()->ajax())
        {
            $data = Store::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $rules = array(
                'name'    =>  'required',
                'number'     =>  'required',
                'address'     =>  'required',
                'image'         =>  'required|image|max:2048'
            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else
        {
            $rules = array(
                'name'    =>  'required',
                'number'     =>  'required',
                'address'     =>  'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        }

        $form_data = array(
            'name'       =>   $request->name,
            'number'        =>   $request->number,
            'address'        =>   $request->address,
            'image'            =>   $image_name
        );
        Store::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);
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
        $data = Store::findOrFail($id);
        $data->delete();
    }
}
