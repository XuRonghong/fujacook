<?php

namespace App\Http\Controllers\Api;

use App\Formatter\Formatter;

use App\Repositories\Bonus\BonusLogRepository;
use App\Repositories\Api\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BonusController extends Controller
{
    protected $memberRepository;
    protected $bonusLogRepo;
    private $formatterPath = 'App\Formatter\Api\Bonus';
    
    public function __construct(
        MemberRepository $memberRepository,
        BonusLogRepository $bonusLogRepo
    ) {
        $this->memberRepository = $memberRepository;
        $this->bonusLogRepo = $bonusLogRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $member = $this->getFormatterInstance()->format(
            $this->bonusLogRepo->getBonusByMember(
                Auth::id(), null, $request, $request->get('per_page', 5), [
            'order',
        ]));
    
        return response()->json([
            'result' => '200',
            'member' => $member,
        ], 200);
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
    }
    
    public function getFormatterInstance() : Formatter
    {
        $formatterName = studly_case(debug_backtrace()[1]['function']);
        
        return app("{$this->formatterPath}\\{$formatterName}");
    }

    public function getBonus()
    {
        $member = $this->memberRepository->find(Auth::id());

        if (empty($member)) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }

        return response()->json([
            'result' => '200',
            'data' => $member->bonus,
        ], 200);
    }
}
