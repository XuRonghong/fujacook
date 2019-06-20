<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\UserVerification;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

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
        //滑動廣告
        $mapBanner['iMenuId'] = 60101;
        $mapBanner['bDel'] = 0;
        $DaoBanner = ModBanner::query()->where( $mapBanner )->get() or [];

        return view('admin.login', compact('DaoBanner'));
    }

    public function forgotPasswordView()
    {
        return view()->make('admin.forgotpassword');
    }

    /*
     *
     */
    public function doLogin ()
    {
        $vAccount = ( Input::has( 'vAccount' ) ) ? Input::get( 'vAccount' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";
        //$mapMember ['vAgentCode'] = $this->vAgentCode;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->first();
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );

            return response()->json( $this->rtndata );
        }
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );

            return response()->json( $this->rtndata );
        }
        if ($DaoMember->iAcType >= 999) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );

            return response()->json( $this->rtndata );
        }
        if ( !$DaoMember->iStatus || !$DaoMember->bActive) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = "您已被停權";

            return response()->json( $this->rtndata );
        }
        $DaoMember->vSessionId = session()->getId();
        $DaoMember->iLoginTime = time();
        $DaoMember->save();

        $DaoSysAgentAccessLV = $DaoMember->iAcType;
        // 選單列表
        $DaoSysMenu = SysMenu::get();

        // 會員選單權限
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId,
            "bSet" => 0
        ];
        $DaoMemberAccessList = SysMemberAccess::where( $mapMemberAccess )->pluck( 'iMenuId' );
        $DaoMemberAccessList = json_decode( json_encode( $DaoMemberAccessList ), true );

        // 會員已存在特別功能權限
        $mapMemberAccess = [
            "iMemberId" => $DaoMember->iId,
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
        // Member
        session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        $DaoMemberInfo = SysMemberInfo::find( $DaoMember->iId );
        session()->put( 'member.info', json_decode( json_encode( $DaoMemberInfo ), true ) );

        //Group
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
        //
        FuncController::_addLog( 'login' );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = url( 'web' );

        return response()->json( $this->rtndata );
    }

    /*
	 *
	 */
    public function doSendVerification ()
    {
        $email = Input::get('email', '');
        $Dao = Admin::query()->where('email', '=', $email)->first();
        if ( !$Dao) {
            return redirect()->back()->withErrors(['email'=>trans( '_web_message.login.error_account' )])->withInput();
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
        $DaoVerification = UserVerification::query()->where('user_id', $user_id)->first();
        if ( !$DaoVerification) {
            $DaoVerification = new UserVerification();
            $DaoVerification->user_id = $user_id;
        }
        $DaoVerification->verification = $verification;
        $DaoVerification->start_time = time();
        $DaoVerification->end_time = $DaoVerification->start_time + config('parameter.verification.time');
        $DaoVerification->status = 0;

        try{
            $DaoVerification->save();
            //畫面
            $mail_tmp = 'email.forgot_password';
            //信件內容
            $mail_arr = [
                "verification" => $verification,
            ];
            //sending..
            Mail::send( $mail_tmp, $mail_arr, function( $message ) use ( $verification, $email ) {
                $message->from( config( 'mail.from.address' ), config( 'mail.from.name' ) );
                $message->subject( trans( '_web_message.verification.forgot_password' ) );
                $message->to( $email );
            } );

            session()->put('verification.userid', $user_id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'email'=> '發生不知名錯誤: '. $e->getMessage()
            ])->withInput();
        }
//        if () {
//            $this->rtndata ['status'] = 1;
//            $this->rtndata ['message'] = trans( '_web_message.verification.success' );
//        } else {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.verification.dail' );
//        }
//        dd(123);
        return response()->json( $this->rtndata );
    }

    public function resetPasswordView()
    {
        return view()->make('admin.auth.passwords.reset');
    }


    public function doResetPassword ()
    {
        $vVerification = ( Input::has( 'vVerification' ) ) ? Input::get( 'vVerification' ) : "";
        $vPassword = ( Input::has( 'vPassword' ) ) ? Input::get( 'vPassword' ) : "";

        $mapMemberVerification['vVerification'] = $vVerification;
        $mapMemberVerification['iStatus'] = 0;
        $DaoMemberVerification = SysMemberVerification::where( $mapMemberVerification )->find( session( 'verification.memberid' ) );
        if ( !$DaoMemberVerification) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );

            return response()->json( $this->rtndata );
        }

        $DaoMember = SysMember::find( $DaoMemberVerification->iMemberId );
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );

            return response()->json( $this->rtndata );
        }
        $DaoMember->iUpdateTime = time();
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        if ($DaoMember->save()) {
            $DaoMemberVerification->iStatus = 1;
            $DaoMemberVerification->save();
            session()->flush();
            $this->rtndata ['status'] = 1;
            $this->rtndata ['rtnurl'] = url( 'web/login' );
            $this->rtndata ['message'] = trans( '_web_message.verification.success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.fail' );
        }

        return response()->json( $this->rtndata );
    }
}
