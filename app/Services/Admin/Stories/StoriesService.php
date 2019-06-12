<?php

namespace App\Services\Admin\Stories;

use Illuminate\Http\Request;
use App\Repositories\Stories\StoriesRepository;
use Validator;
use App\Store;

class StoriesService
{
    protected $repository;

    public function __construct(StoriesRepository $repository)
    {
        $this->repository = $repository;
    }


    public function StoriesRepository()
    {
        return $this->repository;
    }

    public function validate( $request)
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

        return $request->validate($rules, $messages );
    }

    public function moveNewFile(Request $request)
    {
        $image = $request->file('image');

        $new_name = $request->name . rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);

        return $new_name;
    }

    public function formateForm(Request $request, $arr=[])
    {
        $data = array(
            'name'        =>  $request->name,
            'number'         =>  $request->number,
            'address'         =>  $request->address,
        );
        foreach ($arr as $key => $val){
            $data[$key] = $val;
        }
        return $data;
    }

    public function DB_create(Request $request)
    {
        return $this->repository->create($request->all());
    }
}
