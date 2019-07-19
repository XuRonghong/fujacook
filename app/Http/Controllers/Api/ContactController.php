<?php

namespace App\Http\Controllers\Api;

use App\Formatter\Formatter;
use App\Http\Requests\Api\MemberContacts\Store;
use App\Repositories\Api\MemberContactRepository;
use App\Http\Controllers\Controller;
use App\Services\Api\MemberContactService;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * @var \App\Repositories\Member\MemberContactRepository
     */
    protected $memberContactRepo;
    /**
     * @var string
     */
    protected $formatterPath = 'App\Formatter\Api\MemberContact';
    /**
     * @var \App\Services\Api\MemberContactService
     */
    protected $memberContactService;
    
    public function __construct(MemberContactRepository $memberContactRepo, MemberContactService $memberContactService)
    {
        $this->memberContactRepo    = $memberContactRepo;
        $this->memberContactService = $memberContactService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = $this->getFormatterInstance()->format($this->memberContactRepo->getMemberContact(Auth::id()));
        
        return response()->json([
            'result'         => '200',
            'member_contact' => $data,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Store $request)
    {
        $checkLimitAndLastRecords = $this->memberContactService->checkLimit(
            $this->memberContactRepo->getMemberContact(Auth::id(), null, ['sort' => 'updated_at|desc'])
        );
        
        if ($checkLimitAndLastRecords) {
            $this->memberContactRepo->delete($checkLimitAndLastRecords->id);
        }
        
        $this->memberContactRepo->create($request->all());
        
        return response()->json([
            'result'  => '200',
            'message' => '成功更新！',
        ]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->memberContactRepo->delete($id);
        
        return response()->json([
            'result'  => '200',
            'message' => '成功刪除！',
        ]);
    }
    
    /**
     * @param string $methodName
     *
     * @return \App\Formatter\Formatter
     */
    public function getFormatterInstance() : Formatter
    {
        $formatterName = studly_case(debug_backtrace()[1]['function']);
        
        return app("{$this->formatterPath}\\{$formatterName}");
    }
}