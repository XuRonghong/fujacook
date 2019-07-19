<?php

namespace App\Http\Controllers\Api;

use App\Formatter\Formatter;
use App\Http\Requests\Api\Members\SetPassword;
use App\Http\Requests\Api\Members\Update;
use App\Http\Requests\Api\Members\Upload;
use App\Repositories\Member\MemberRepository;
use App\Services\UploadService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    use Transaction;
    
    /**
     * @var \App\Repositories\Member\MemberRepository
     */
    protected $memberRepo;
    private $formatterPath = 'App\Formatter\Api\Members';
    
    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = $this->getFormatterInstance()->format($this->memberRepo->getMemberByEmail(Auth::user()->email));
        
        if (empty($member)) {
            throw new HttpResponseException(response()->json([
                'result' => '400',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }
        
        return response()->json([
            'result' => '200',
            'member' => $member,
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $member = $this->getFormatterInstance()->format($this->memberRepo->getMemberByEmail(Auth::user()->email));
        
        if (empty($member)) {
            throw new HttpResponseException(response()->json([
                'result' => '400',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }
        
        return response()->json([
            'result' => '200',
            'member' => $member,
        ], 200);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    private function update(Update $request)
    {
        $this->memberRepo->update($request->all(), Auth::id());
        
        return response()->json([
            'result' => '200',
            'message' => '成功更新！',
        ]);
    }
    
    public function getFormatterInstance() : Formatter
    {
        $formatterName = studly_case(debug_backtrace()[1]['function']);
        
        return app("{$this->formatterPath}\\{$formatterName}");
    }
    
    private function upload(Upload $request)
    {
        $file = $request->file('file');
        
        $uploadService = app(UploadService::class);
        
        $url = $uploadService->upload($file, 'upload/images/original');
        
        if ($url) {
            $fileName = $uploadService->getFilename($url);
            $urlSmall = $uploadService->uploadImageWithResizeAndQuality(
                $file,
                'upload/images/small',
                $fileName,
                400,
                400,
                50
            );
            
            $urlLarge = $uploadService->uploadImageWithResizeAndQuality(
                $file,
                'upload/images/large',
                $fileName,
                800,
                800,
                90
            );

            $result = [
                'result' => '200',
                'data' => $urlSmall,
            ];

            $member = Auth::user();
            $member->avatar = $urlSmall;
            $member->save();
        } else {
            $result['result'] = '400';
            $result['error_message'] = '檔案上傳失敗';
        }
        
        return response()->json($result);
    }
    
    private function setPassword(SetPassword $request)
    {
        $member = $this->memberRepo->getMemberByEmail(Auth::user()->email);
        
        if (filled($member)) {
            if (Hash::check($request->currPassword, $member->password)) {
                $member->password = bcrypt($request->newPassword);
                $member->save();
                
                return response()->json([
                    'result'  => '200',
                    'message' => '成功更新！',
                ]);
            } else {
                return response()->json([
                    'result'  => '422',
                    'error_message' => ['currPassword'=>['密碼更新失敗']],
                ]);
            }
        }
        
        return response()->json([
            'result'  => '400',
            'message' => 'ＧＧ囉！',
        ]);
    }
}
