<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class UploadfileController extends Controller
{
    //
    function index()
    {
        return view('uploadfile');
    }

    //
    function upload(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        $image = $request->file('select_file');

        $new_name = rand() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('images'), $new_name);
        return back()->with('success', 'Image Uploaded Successfully')->with('path', $new_name);
    }




    function AjaxUpload(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($validation->passes())
        {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            return response()->json([
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/images/'.$new_name.'" class="img-thumbnail" width="300" />',
                'class_name'  => 'alert-success'
            ]);
        }
        else
        {
            return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }
}
