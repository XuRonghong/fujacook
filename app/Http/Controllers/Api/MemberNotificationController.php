<?php

namespace App\Http\Controllers\Api;

use App\Formatter\Formatter;
use App\Repositories\Member\NotificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberNotificationController extends Controller
{
    /**
     * @var \App\Repositories\Member\NotificationRepository
     */
    protected $notificationRepo;
    private   $formatterPath = 'App\Formatter\Api\Notifications';
    
    public function __construct(NotificationRepository $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notifications = $this->notificationRepo->byMember()->getNotifications(
            $request->all(), $request->get('per_page', 10), [
            'members' => function ($query) {
                $query->where('id', Auth::id());
            },
        ]);
        
        $data = $this->getFormatterInstance()->format($notifications);
        
        return response()->json([
            'notifications' => $data,
            'result'        => '200',
        ], 200);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    public function isRead($id)
    {
        $this->notificationRepo->isRead($id);
        
        return response()->json([
            'message' => 'ok',
            'result'  => '200',
        ]);
    }
    
    public function getFormatterInstance() : Formatter
    {
        $formatterName = studly_case(debug_backtrace()[1]['function']);
        
        return app("{$this->formatterPath}\\{$formatterName}");
    }

    public function getUnreadCount()
    {
        $unreadCount = Auth::user()->notifications()->wherePivot('is_read', 0)->count();

        return response()->json([
            'message' => 'ok',
            'result'  => '200',
            'unreadCount' => $unreadCount
        ]);
    }
}
