<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\AdminInfo;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\UserVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{

    /*
     *
     */
    public function __construct ()
    {

    }

    public function index ()
    {
        // set_meta_og
        $og = [
            "url"           => url('login'),
            "type"          => "website",
            "title"         => config( '_website.web_title' ),
            "description"   => config( '_website.web_description' ),
            "images"        => 'portal_assets/dist/img/logo.png',
        ];

        return view('admin.login', compact('og'));
    }

    public function doLogin ()
    {
        $vAccount = ( Input::has( 'vAccount' ) ) ? Input::get( 'vAccount' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";
        //$mapMember ['vAgentCode'] = $this->vAgentCode;
        $map ['account'] = Input::get('vAccount','');
        $User = Admin::query()->where($map)->first();
        if ( !$User) {
//            return redirect()->back()->withErrors(['email'=>trans( 'web_message.login.error_account' )])->withInput();
            return response()->json([
                'status' => 0,
                'message' => trans( 'web_message.login.error_account' ),    //"帳號不存在",
            ], 204);    //No Content : 伺服器成功處理了請求，沒有返回任何內容。
        }
//        $password = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        $password = Hash::make(Input::get('password',''));
        if ($User->password != $password) {
//            return redirect()->back()->withErrors(['email'=>trans( 'web_message.login.error_password' )])->withInput();
            return response()->json([
                'status' => 0,
                'message' => trans( 'web_message.login.error_password' ),    //"密碼錯誤",
            ], 202);  //Accepted : 伺服器已接受請求，但尚未處理。最終該請求可能會也可能不會被執行，並且可能在處理發生時被禁止。
        }
        if ($User->type > 99) {
//            return redirect()->back()->withErrors(['email'=>trans( 'web_message.login.error_access' )])->withInput();
            return response()->json([
                'status' => 0,
                'message' => trans( 'web_message.login.error_access' ), //"帳號權限異常，請聯絡管理員"
            ], 202);  //Accepted : 伺服器已接受請求，但尚未處理。最終該請求可能會也可能不會被執行，並且可能在處理發生時被禁止。
        }
        if ( !$User->status || !$User->active) {
//            return redirect()->back()->withErrors(['email'=>trans( 'web_message.login.error_active' )])->withInput();
            return response()->json([
                'status' => 0,
                'message' => trans( 'web_message.login.error_active' ), //"帳號被停權"
            ], 403);  // Forbidden : 用戶端並無訪問權限，所以伺服器給予應有的回應。
        }

        $User->session_id = session()->getId();
        $User->login_time = date('Y-m-d H:i:s');
        $User->save();


        //$this->getMemberAccessList_fun2016($User);


        // Session save User
        session()->put('user', json_decode( json_encode($User, JSON_UNESCAPED_UNICODE), true));
        // Session save UserInfo
        $UserInfo = AdminInfo::query()->where('user_id', $User->id )->first();
        session()->put('user.info', json_decode( json_encode($UserInfo,JSON_UNESCAPED_UNICODE), true));

        // User Group for fun2016
        //$this->sessionMemberGroup_fun2016()

        // recode log..
        FuncController::addLog('admin login', $User->id);

        return response()->json([
            'status' => 1,
            'message' => trans('web_message.login.success'),
            'rtnurl' => url( 'admin' )
        ], 200);
    }

    /*
     * 其他方登入 (未整理)
     */
    public function doLoginOther ( Request $request )
    {

        $vAccount  = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "";
        $vPassword = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";
        $type = ( $request->exists( 'type' ) ) ? $request->input( 'type' ) : "other";

        if ($vAccount == "")
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }

        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->first();
        if ( !$DaoMember) {
            $str = md5( uniqid( mt_rand(), true ) );
            $uuid = substr( $str, 0, 8 ) . '-';
            $uuid .= substr( $str, 8, 4 ) . '-';
            $uuid .= substr( $str, 12, 4 ) . '-';
            $uuid .= substr( $str, 16, 4 ) . '-';
            $uuid .= substr( $str, 20, 12 );
            do {
                $userid = rand( 1000000001, 1099999999 );
                $check = SysMember::where( "iUserId", $userid )->first();
            } while ($check);

            $date_time = time();
            $DaoMember = new SysMember ();
            $DaoMember->iUserId = $userid;
            $DaoMember->vUserCode = $uuid;
            $DaoMember->vAgentCode = config( '_config.agent_code' ) . "-" . $type;
            $DaoMember->iAcType = 999; //
            $DaoMember->vAccount = $vAccount;
            $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
            $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
            $DaoMember->vCreateIP = $request->ip();
            $DaoMember->bActive = 1;
            $DaoMember->iStatus = 1;

            if ($DaoMember->save()) {
                $DaoMemberInfo = new SysMemberInfo();
                $DaoMemberInfo->iMemberId = $DaoMember->iId;
                $DaoMemberInfo->vUserImage = "/images/empty.jpg";
                $DaoMemberInfo->vUserName = ( $request->exists( 'vUserName' ) ) ? $request->input( 'vUserName' ) : $vAccount;
                $DaoMemberInfo->vUserID =   ( $request->exists( 'vUserID' ) ) ? $request->input( 'vUserID' ) : "";
                $DaoMemberInfo->iUserBirthday = time();
                $DaoMemberInfo->vUserContact = ( $request->exists( 'vUserContact' ) ) ? $request->input( 'vUserContact' ) : "";
                $DaoMemberInfo->vUserEmail = "";
                $DaoMemberInfo->save();

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.register.success' );
                $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'login' );

                $DaoGroupMember = new SysGroupMember();
                $DaoGroupMember->iGroupId = 5;
                $DaoGroupMember->iMemberId = $DaoMember->iId;
                $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                $DaoGroupMember->iStatus = 1;
                $DaoGroupMember->save();

                //
                // CoinController::_CheckActivityRegister( $DaoMember->iId );

            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.register.fail' );
                return response()->json( $this->rtndata );
            }
        } else {
//            switch ($type) {
//                case 'FB':
//                    $access_token = $request->input( 'accessToken' );
//                    $fb = new Facebook( [
//                        'app_id' => config( '_config.fb_appid' ),
//                        'app_secret' => config( '_config.fb_secret' ),
//                        'default_graph_version' => config( '_config.fb_ver' ),
//                    ] );
//                    try {
//                        $response = $fb->get( '/me', $access_token );
//                    }
//                    catch (FacebookResponseException $e) {
//                        // When Graph returns an error
//                        $this->rtndata ['status'] = 0;
//                        $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
//                        return response()->json( $this->rtndata );
//                    }
//                    catch (FacebookSDKException $e) {
//                        // When validation fails or other local issues
//                        $this->rtndata ['status'] = 0;
//                        $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
//                        return response()->json( $this->rtndata );
//                    }
//                    //$me = $response->getGraphUser();
//                    break;
//                case 'GPLUS':
//                    break;
//                default:
//            }
        }

        //帳號是否有啟用
        if ( !$DaoMember->bActive)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_active' );
            return response()->json( $this->rtndata );
        }
        //帳號狀態是否正常
        if ($DaoMember->iStatus == 0)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_status' );
            return response()->json( $this->rtndata );
        }

        // Member
        session()->put( 'shop_member', json_decode( json_encode($DaoMember, JSON_UNESCAPED_UNICODE), true ) );
        // MemberInfo
        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );
        session()->put( 'shop_member.info', json_decode( json_encode($DaoMemberInfo, JSON_UNESCAPED_UNICODE), true ) );

        // MemberGroup join ModActivitySchedule
        $iGroupId = SysGroupMember::query()->where('iMemberId', '=', $DaoMember->iId)->first()->iGroupId;
        if ( !$iGroupId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '會員無群組';
            return response()->json( $this->rtndata );
        }
        $iActivityScheduleId = ModActivityScheduleGroup::query()->where('iGroupId', '=', $iGroupId)->first()->iActivityScheduleId;
        // ActivitySchedule
        $DaoActivitySchedule = ModActivitySchedule::query()->where( 'iId', '=', $iActivityScheduleId )->first();
        $DaoActivityScheduleInfo = ModActivityScheduleInfo::query()->where( 'iActivityScheduleId', '=', $iActivityScheduleId )->first();
        session()->put('shop_activity_schedule', json_decode( json_encode( $DaoActivitySchedule ), true ) );
        session()->put('shop_activity_schedule_info', json_decode( json_encode( $DaoActivityScheduleInfo ), true ) );
        //
        $this->order_limit_price = $DaoActivityScheduleInfo->iOrderLimitPrice ;
        $this->order_code = $DaoActivityScheduleInfo->vOrderCode ;


        //Activity
        //CoinController::_CheckActivityLogin();

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'member_center/information' );

        return response()->json( $this->rtndata );
    }


    /*
     * 忘記密碼
     */
    public function forgotPasswordView()
    {
        return view()->make('admin.forgotpassword');
    }

    /*
     * 寄送更改密碼驗證信
     */
    public function doSendVerification()
    {
        $email = Input::get('email', '');
        $Dao = Admin::query()->where('email', '=', $email)->first();
        if ( !$Dao) {
            return redirect()->back()->withErrors(['email'=>trans( 'web_message.login.error_account' )])->withInput();
        }

        //產生驗證碼
        $verification = "";
        for ($i = 0 ; $i < config( 'parameter.verification.limit' ) ; $i++) {
            if (rand( 0, 1 )) {
                $verification .= rand( 1, 9 );
            } else {
                $str_arr = config( 'parameter.str_arr' );
                $verification .= $str_arr [rand( 0, count( $str_arr ) - 1 )];
            }
        }

        //寫入資料表
        $user_id = $Dao->id;
        $start_time = time();
        $end_time = $start_time + config('parameter.verification.time');
        $DaoVerification = UserVerification::query()->where('user_id', $user_id)->first();
        if ( !$DaoVerification) {
            $DaoVerification = new UserVerification();
            $DaoVerification->user_id = $user_id;
            $DaoVerification->user_table = 'admins';
        }
        $DaoVerification->verification = $verification;
        $DaoVerification->start_time = date('Y-m-d H:i:s', $start_time);
        $DaoVerification->end_time = date('Y-m-d H:i:s', $end_time);
        $DaoVerification->status = 0;

        try{
            $DaoVerification->save();
            //畫面
            $mail_tmp = 'email.forgot_password';

            //信件內容
            $mail_arr = [
                "verification" => $verification,
                'url' => route('admin.password.verification'),
                'app_name' => config('app.name'),
            ];

            //Laravel sending..
//            Mail::send( $mail_tmp, $mail_arr, function( $message ) use ( $verification, $email ) {
//                $message->from( config( 'mail.from.address' ), config( 'mail.from.name' ) );
//                $message->subject( trans( 'web_message.verification.forgot_password' ) );
//                $message->to( $email );
//            } );

            //Fujacook sending..
            $finish = PHPsendMail_fuja(
                $email,
                trans( 'web_message.verification.forgot_password' ),
                $mail_arr,
                config( 'mail.from.address' )
            );

            session()->put('verification.userid', $user_id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([ //發生不知名錯誤
                'email'=> htmlspecialchars_decode(trans('web_message.unknow_error'). $e->getMessage())
            ])->withInput();
        }
        return redirect( route('admin.password.verification'))->with('verification.email', $email);
    }


    /*
     * 重設密碼
     */
    public function resetPasswordView()
    {
        return view()->make('admin.auth.passwords.reset');
    }

    public function doResetPassword ()
    {
        //資料庫有沒有使用者資訊
        $User = Admin::query()->where('active', 1)
            ->where('email', Input::get('email',''))
            ->orWhere('id', session('verification.memberid'))
            ->first();
        if ( !$User) {
            return redirect()->back()->withErrors([
                'email'=>trans( 'web_message.verification.no_user' )
            ])->withInput();
        }

        //比對有沒有此驗證資訊
        $map = [
            'user_id' => $User->id,
            'verification' => Input::get('verification', 0),
            'status' => 0,
        ];
        $Verification = UserVerification::query()->where($map)->first();
        if ( !$Verification) {
            return redirect()->back()->withErrors([
                'verification'=>trans( 'web_message.verification.error' )
            ])->withInput();
        }

//        $User->password = hash( 'sha256', $User->vAgentCode . $vPassword . $User->vUserCode );
        $User->password = Hash::make(Input::get('password',''));

        try{
            //儲存更改資料
            $User->save();
            //驗證碼成功
            $Verification->status = 1;
            $Verification->save();
            //清理session
            session()->flush();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'verification'=> htmlspecialchars_decode(
                    trans('web_message.verification.fail' ).': '.$e->getMessage()
                )
            ])->withInput();
        }

        return redirect( route('admin.login.index'));
    }



    /*
     *
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect ()->guest ( 'web/login' );
    }

    /*  */
    public function doLogout()
    {
        session ()->flush ();
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans ( '_web_message.logout.success' );
        return response ()->json ( $this->rtndata );
    }



    // 2016 function ~~
    public function getMemberAccessList_fun2016($User)
    {
        $DaoSysAgentAccessLV = $User->type;
        // 選單列表
        $DaoSysMenu = SysMenu::get();

        // 會員選單權限
        $mapMemberAccess = [
            "iMemberId" => $User->id,
            "bSet" => 0
        ];
        $DaoMemberAccessList = SysMemberAccess::where( $mapMemberAccess )->pluck( 'iMenuId' );
        $DaoMemberAccessList = json_decode( json_encode( $DaoMemberAccessList ), true );

        // 會員已存在特別功能權限
        $mapMemberAccess = [
            "iMemberId" => $User->id,
            "bSet" => 1
        ];
        $DaoMemberAccessListSet = SysMemberAccess::where( $mapMemberAccess )->pluck( 'iMenuId' );
        $DaoMemberAccessListSet = json_decode( json_encode( $DaoMemberAccessListSet ), true );
        foreach ($DaoSysMenu as $key => $var) {
            if ( !in_array( $var->iId, $DaoMemberAccessListSet )) {
                $vAccess_arr = explode( ",", $var->vAccess );
                if ( !in_array( $var->iId, $DaoMemberAccessList )) {
                    $DaoAccess = new SysMemberAccess ();
                    $DaoAccess->iMemberId = $DaoMember->iId;
                    $DaoAccess->iMenuId = $var->iId;
                    $DaoAccess->bOpen = ( $DaoSysAgentAccessLV && in_array( $DaoSysAgentAccessLV, $vAccess_arr ) ) ? 1 : 0;
                    $DaoAccess->bSet = 0;
                    $DaoAccess->save();
                } else {
                    $mapMemberAccess2 = [
                        "iMemberId" => $DaoMember->iId,
                        "iMenuId" => $var->iId
                    ];
                    $DaoAccess2 = SysMemberAccess::where( $mapMemberAccess2 )->first();
                    $DaoAccess2->bOpen = ( $DaoSysAgentAccessLV && in_array( $DaoSysAgentAccessLV, $vAccess_arr ) ) ? 1 : 0;
                    $DaoAccess2->save();
                }
            }
        }
        // 取得會員已存在功能權限array
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId
        ];
        $DaoMemberAccessArr = SysMemberAccess::where( $mapMemberAccess )->select( 'iMenuId', 'bOpen' )->get();
        foreach ($DaoMemberAccessArr as $key => $var) {
            session()->put( 'access.' . $var->iMenuId, $var->bOpen );
        }
    }

    public function sessionMemberGroup_fun2016()
    {
        $DaoGroupMember = SysGroupMember::join( 'sys_group', function( $join ) {
            $join->on( 'sys_group.iId', '=', 'sys_group_member.iGroupId' );
        } )->where( 'sys_group_member.iMemberId', $DaoMember->iId )->select( 'sys_group.*' )->get();
        foreach ($DaoGroupMember as $item) {
            switch ($item->iGroupType) {
                case 3:
                    session()->put( 'employee', json_decode( json_encode( $item ), true ) );
                    break;
                case 4:
                    session()->put( 'store', json_decode( json_encode( $item ), true ) );
                    break;
                case 5:
                    session()->put( 'blogger', json_decode( json_encode( $item ), true ) );
                    break;
                case 6:
                    session()->put( 'supplier', json_decode( json_encode( $item ), true ) );
                    break;
            }
        }
    }
}
