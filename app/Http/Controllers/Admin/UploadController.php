<?php

namespace App\Http\Controllers\Admin;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    /*
     *
     */
    public function __construct ()
    {
//        parent::__construct();
    }


    /*
     *
     */
    public function doUploadImage ( Request $request )
    {
        switch (config( 'filesystems.default' )) {
            case 's3':
                $image = $request->file( 'files' );
                $storage = Storage::disk( 's3' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = '/' . config()->get( '_config.file_path' ) . session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, file_get_contents( $image ) );
                //
                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 1;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'AWS_S3_SERVER' );
                $Dao->vFilePath = '/' . env( 'AWS_BUCKET' ) . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $image->getClientSize();
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();
                //
                $file['name'] = $filename;
                $file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
                $this->rtndata['files'][0] = $file;
                break;
            default:
                $image = $request->file( 'files' );
                $storage = Storage::disk( 'public' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, file_get_contents( $image ) );

                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 2;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'APP_URL' );
                $Dao->vFilePath = '/upload/userdata/' . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $image->getClientSize();
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();

                $file['name'] = $filename;
                $file['url'] = $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName;
                $this->rtndata['files'][0] = $file;
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function doUploadImageBase64(Request $request)
    {
        if ( !$request->exists('image')) {
            return response()->json([
                'status' => 0,
                'message' => trans('_web_message.upload.fail'),
            ], 204);
        }

        $image = explode( ',', $request->input('image'));
        $data = base64_decode($image[1]);

        switch (config('filesystems.default')) {
            case 's3':
                $storage = Storage::disk('s3');
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = '/' . config()->get( '_config.file_path' ) . session()->get( 'member.user_code' );
                $storage->put( $filePath . '/' . $filename, $data );
                //
                $Dao = new SysFiles ();
                $Dao->iMemberId = session()->get( 'member.iId' );
                $Dao->iType = 3;
                $Dao->vFileType = 'image/jpeg';
                $Dao->vFileServer = env( 'AWS_S3_SERVER' );
                $Dao->vFilePath = '/' . env( 'AWS_BUCKET' ) . $filePath . '/';
                $Dao->vFileName = $filename;
                $Dao->iFileSize = $storage->size( $filePath . '/' . $filename );
                $Dao->iCreateTime = $Dao->iUpdateTime = time();
                $Dao->iStatus = 1;
                $Dao->save();
                $rtndata = [
                    'fileid' => $Dao->iId,
                    'path' => $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName
                ];
                break;
            default:
                $storage = Storage::disk( 'public' );
                $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                $filePath = '/upload/admindata/'.Auth::guard('admin')->user()->account; //session()->get( 'member.vUserCode' );
                $storage->put( $filePath . '/' . $filename, $data );
                //
                $Dao = new File();
                $Dao->author_id = Auth::guard('admin')->user()->id; //session()->get( 'member.iId' );
                $Dao->type = 4;
                $Dao->file_type = 'image/jpeg';
                $Dao->file_server = env( 'APP_URL' );
                $Dao->file_path = '/storage' . $filePath . '/';
                $Dao->file_name = $filename;
                $Dao->file_size = $storage->size( $filePath . '/' . $filename );
                $Dao->open = 1;
                $Dao->save();
                $rtndata = [
                    'fileid' => $Dao->id,
                    'path' => $Dao->file_server . $Dao->file_path . $Dao->file_name
                ];
        }

        return response()->json([
            'status' => 0,
            'info' => $rtndata,
        ], 200 );
    }


    /*
     *
     */
    public function _addFile ( $file_info )
    {
        $Dao = new SysFiles ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iType = 2;
        $Dao->vFileType = $file_info->type;
        $tmp_arr = explode( config()->get( '_config.file_path' ), dirname( $file_info->url ), 2 );
        $Dao->vFileServer = $tmp_arr [0];
        $Dao->vFilePath = config()->get( '_config.file_path' ) . $tmp_arr [1];
        $Dao->vFileName = $file_info->name;
        $Dao->iFileSize = $file_info->size;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->save();

        return $Dao->iId;
    }


    /*
     * 這裡做上傳檔案 *.pdf
     */
    public function doUploadFile(Request $request)
    {
        if ( !$request->hasFile('file') || !$request->file( 'file' ) || !$request->file('file')->isValid() ) {
            return response()->json([
                'status' => 0,
                'message' => trans('_web_message.upload.fail'),
            ], 204);
        }

        try {
            $data = $request->file('file');
            //取得上傳檔案所在的路徑
            $path = $request->file('file')->getRealPath();
            //取得上傳檔案的原始名稱
            $name = $request->file('file')->getClientOriginalName();
            //取得上傳檔案的大小
            $size = $request->file('file')->getSize();
            //取得上傳檔案的副檔名
            $extension = $request->file('file')->getClientOriginalExtension();
            //取得上傳檔案的 MIME 類型
            $mime = $request->file('file')->getMimeType();

            if ($extension!='pdf' || $mime!='application/pdf'){
                return response()->json([
                    'status' => 0,
                    'message' => trans('_web_message.upload.fail').' : not PDF !!',
                ], 204);
            }
//            $image = explode(',', $request->file('file'));
//            $data = base64_decode($image [1]);

            switch (config('filesystems.default')) {
                case 's3':
                    $storage = Storage::disk( 's3' );
                    $filename = date( 'YmdHis' ) . uniqid() . '.jpg';
                    $filePath = '/' . config()->get( '_config.file_path' ) . session()->get( 'member.vUserCode' );
                    $storage->put( $filePath . '/' . $filename, $data );
                    //
                    $Dao = new SysFiles ();
                    $Dao->iMemberId = session()->get( 'member.iId' );
                    $Dao->iType = 3;
                    $Dao->vFileType = 'image/jpeg';
                    $Dao->vFileServer = env( 'AWS_S3_SERVER' );
                    $Dao->vFilePath = '/' . env( 'AWS_BUCKET' ) . $filePath . '/';
                    $Dao->vFileName = $filename;
                    $Dao->iFileSize = $storage->size( $filePath . '/' . $filename );
                    $Dao->iCreateTime = $Dao->iUpdateTime = time();
                    $Dao->iStatus = 1;
                    $Dao->save();
                    $rtndata = [
                        'fileid' => $Dao->iId,
                        'path' => $Dao->vFileServer . $Dao->vFilePath . $Dao->vFileName
                    ];
                    break;
                default:
                    $storage = Storage::disk( 'public' );
                    $filename = date( 'YmdHis' ) . uniqid() . '.'.$extension;
                    $filePath = '/upload/admindata/'. Auth::guard('admin')->user()->account; //session()->get( 'member.vUserCode' );

//                    $storage->put($filePath . '/' . $filename, $path);
                    $request->file('file')->move( public_path('/storage' . $filePath ) , $filename);
                    //
                    $Dao = new File();
                    $Dao->author_id = Auth::guard('admin')->user()->id; //session()->get( 'member.iId' );
                    $Dao->type = 4;
                    $Dao->file_type = $mime;
                    $Dao->file_server = env( 'APP_URL' );
                    $Dao->file_path = '/storage' . $filePath . '/';
                    $Dao->file_name = $filename;
                    $Dao->file_size = $storage->size( $filePath . '/' . $filename );
                    $Dao->open = 1;
                    $Dao->save();
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'status' => 1,
            'message' => trans( '_web_message.upload.success' ),
            'fileid' => $Dao->id,
        ], 200);
    }
}
