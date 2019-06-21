<?php

namespace App\Http\Controllers\_API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use App\SysMemberAccess;
use App\SysAgentAccess;
use App\SysMenu;
use App\SysMemberVerification;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\ModRevenueDaily;


class LoginController extends _WebController
{

    protected $vAgentCode = "KAP10001";
    protected $_token = "oxymrssVCB6D724F1F658xjvo95DNNSwivRBuOctyoorX425DF487";


    /*
     *
     */
    public function indexView ()
    {

        $this->module = [ 'login' ];
        $this->view = View()->make( "_web." . implode( '.' , $this->module ) );


        /*
         *  判斷裝置手機版或電腦版(api無用到)
         */
//        $this->agent = new Agent();
//        if ( $this->agent->isMobile() && !$this->agent->isTablet() ) {
//            $this->view = View()->make( "_template_mobile." . implode( '.' , $this->module ) );
//            if ($this->agent->browser()){
//                $this->view = View()->make( "_web." . implode( '.' , $this->module ) . '_ff' );
//                $this->view->with( 'url_dologin', url('web/doLoginMobile'));
//            } else {
//                $this->view->with('url_dologin', url('web/doLoginMobile'));
//            }
//        } else {
//            $this->view = View()->make( "_template_portal." . implode( '.' , $this->module ) );
            $this->view->with( 'url_dologin', url('web/doLogin'));
//        }

        return $this->view;
    }


    /*
     * 登入判斷
     */
    public function doLogin ( Request $request )
    {
        $method  = ( $request->exists( 'method' ) ) ? $request->input( 'method' ) : "";
        $vAccount  = ( $request->exists( 'account' ) ) ? $request->input( 'account' ) : "";
        $vPassword = ( $request->exists( 'password') ) ? $request->input( 'password' ) : "";
        $fb_or_google_id = ( $request->exists( 'id') ) ? $request->input( 'id' ) : "";

        // null error
        $this->rtndata ['status'] = 0;
        if ($method=='') $this->rtndata ['message'] = 'account is empty';
//        elseif ($method=='') $this->rtndata ['message'] = 'method is empty';
//        elseif ($vBirthday=='') $this->rtndata ['message'] = 'birthday is empty';
//        elseif ($vNationality=='') $this->rtndata ['message'] = 'lang is empty';



            $AcType = 80;           //預設80 (Google login)  
            switch ($method) {
                //----------------  一般登入 -------------------
                case 1:
                    //帳號email格式是否正確
                    if ($vAccount != "" && !FuncController::_isValidEmail($vAccount)) {
                        $this->rtndata ['status'] = 0;
                        $this->rtndata ['message'] = 'login.error_accoutn:\n' . trans('web_message.register.error_account');
                        return response()->json($this->rtndata);
                    }
                    //帳號是否存在
                    $mapMember ['vAccount'] = $vAccount;
                    $DaoMember = SysMember::query()->where($mapMember)->first();
                    if (!$DaoMember) {
                        $this->rtndata ['status'] = 0;
                        $this->rtndata ['message'] = 'account is empty:\n' . trans('web_message.login.error_account');
                        return response()->json($this->rtndata);
                    }
                    //密碼是否一樣
                    if ($DaoMember->vPassword != hash('sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode)) {
                        $this->rtndata ['status'] = 0;
                        $this->rtndata ['message'] = 'error_password:\n' . trans('web_message.login.error_password');
                        return response()->json($this->rtndata);
                    }
                    //帳號是否有啟用
                    if (!$DaoMember->bActive) {
                        $this->rtndata ['status'] = 0;
                        $this->rtndata ['message'] = 'no active:\n' . trans('web_message.login.error_active');
                        return response()->json($this->rtndata);
                    }
                    //帳號狀態是否正常
                    if ($DaoMember->iStatus == 0) {
                        $this->rtndata ['status'] = 0;
                        $this->rtndata ['message'] = 'no status:\n' . trans('web_message.login.error_status');
                        return response()->json($this->rtndata);
                    }

                    //
                    FuncController::_addLog( 'Portal general login' );
                    break;

                //----------------  FB登入 -------------------
                case 2:
                    $AcType = 90;
                //----------------  Google登入 -------------------
                case 3:
                    $mapFB['vFacebookId'] = $fb_or_google_id;
                    $mapGo['vGoogleId'] = $fb_or_google_id;
                    $DaoMember = SysMember::query()->where($mapFB)->orWhere($mapGo)->first();
                    if ($DaoMember)
                    {
                        $DaoMember->vSessionId = session()->getId();
                        $DaoMember->iLoginTime = time();
                        //紀錄登入時間與識別碼
                        $DaoMember->save();

                        //
                        FuncController::_addLog( 'Portal social login' );
                    }
                    else 
                    {
                        $str = md5( uniqid( mt_rand(), true ) );
                        $uuid = substr( $str, 0, 8 ) . '-';
                        $uuid .= substr( $str, 8, 4 ) . '-';
                        $uuid .= substr( $str, 12, 4 ) . '-';
                        $uuid .= substr( $str, 16, 4 ) . '-';
                        $uuid .= substr( $str, 20, 12 );
                        do {
                            $userid = rand( 1000000001, 1099999999 );
                            $check = SysMember::query()->where( "iUserId", $userid )->first();
                        } while ($check);

                        //
                        $date_time = time();
                        $DaoMember = new SysMember ();
                        $DaoMember->vAgentCode = config( '_config.agent_code' );
                        $DaoMember->iUserId = $userid;
                        $DaoMember->vUserCode = $uuid;
                        $DaoMember->iAcType = $AcType;       //99一般使用者
                        if ($method==2) {
                            $DaoMember->vFacebookId = $fb_or_google_id;
                            //
                            FuncController::_addLog( 'Portal fb login' );
                        }
                        elseif ($method==3) {
                            $DaoMember->vGoogleId = $fb_or_google_id;
                            //
                            FuncController::_addLog( 'Portal google login' );
                        }
                        $DaoMember->vAccount = $vAccount;
                        $DaoMember->vEmail = $vAccount;
//                        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
                        $DaoMember->vCreateIP = $request->ip();
                        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
                        //
                        $DaoMember->vSessionId = session()->getId();
                        $DaoMember->iLoginTime = time();
                        $DaoMember->bActive = 1;
                        $DaoMember->iStatus = 1;
                        //
                        if ($DaoMember->save()) {
                            try {
                                //註冊會員的詳情資料
                                $DaoMemberInfo = new SysMemberInfo();
                                $DaoMemberInfo->iMemberId = $DaoMember->iId;
                                $DaoMemberInfo->vUserImage = "/images/empty.jpg";
                                $DaoMemberInfo->vUserName = ($request->exists('vUserName')) ? $request->input('vUserName') : '';
//                                $DaoMemberInfo->vNationality = $vNationality;
//            $DaoMemberInfo->vUserID =   ( $request->input( 'vUserID' ) )   ? $request->input( 'vUserID' ) : "";
//                                $DaoMemberInfo->iUserBirthday = strtotime($vBirthday);
//            $DaoMemberInfo->vUserEmail = FuncController::_isValidEmail( $vAccount ) ? $vAccount : '';
                                $DaoMemberInfo->vUserContact = $request->exists('vUserContact') ? $request->input('vUserContact') : "";
                                $DaoMemberInfo->save();

                                //註冊會員的群組,預設'5'的一般會員群組
                                $DaoGroupMember = new SysGroupMember();
                                $DaoGroupMember->iGroupId = 5;
                                $DaoGroupMember->iMemberId = $DaoMember->iId;
                                $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                                $DaoGroupMember->iStatus = 1;
                                $DaoGroupMember->save();

//                                $this->rtndata ['status'] = 1;
//                                $this->rtndata ['message'] = 'register success:\n'.trans('web_message.register.success') . trans('web_message.register.verification');
//                                $this->rtndata ['url'] = url('/api/auth/doActive') .'/'. $uuid;

                                /*Mail::send('_email.welcome', ['url' => url('/api/auth/doActive') .'/'. $uuid], function ($message) use ($vAccount) {
                                    $message->to($vAccount, '會員')->subject('Register Success!');
                                });*/

                            } catch (\Exception $e){
                                $this->rtndata ['status'] = 0;
                                $this->rtndata ['message'] = $e->getMessage() .'\n'. trans( 'web_message.register.send_active' );
                                return response()->json( $this->rtndata );
                            }
                            //
                            //CoinController::_CheckActivityRegister( $DaoMember->iId );
                        } else {
                            $this->rtndata ['status'] = 0;
                            $this->rtndata ['message'] = 'register.save_fail:\n'.trans( 'web_message.register.fail' );
                            return response()->json( $this->rtndata );
                        }

                    }
                    break;
                //----------------  拒絕 -------------------
                default:
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = 'method select error:\n';
                    return response()->json($this->rtndata);
            }


        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = 'login success:\n'.trans( 'web_message.login.success' );
//        $this->rtndata ['rtnurl'] =  session()->has( 'rtnurl' ) ? session()->get( 'rtnurl' ) : url('web/member');
//        $this->rtndata ['isMobile'] = false;
        $this->rtndata ['uid'] = $DaoMember->iId;

        return response()->json( $this->rtndata );
    }


    /*
     * 寄送郵件驗證重設密碼
     */
    public function doSendVerification ( Request $request )
    {
        $iUserId  = ( $request->exists( 'iUserId' ) ) ? htmlspecialchars($request->input( 'iUserId' )) : "" ;
        $vAccount = $request->exists( 'account' ) ? htmlspecialchars($request->input( 'account' )) : "";
        $mail_url_lang  = ( $request->exists( 'mail_url_lang' ) ) ? htmlspecialchars($request->input( 'mail_url_lang' )) : "" ;

        if (  $vAccount!="" && !FuncController::_isValidEmail( $vAccount )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'forgetpw.error_account:\n'.trans( 'web_message.register.error_account' );
            return response()->json( $this->rtndata );
        }
        if ($vAccount == "" /*&& $iUserId == ""*/)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'input empty:\n'.trans( 'web_message.login.error_account' ).time();
            return response()->json( $this->rtndata );
        }


        $mapStaff ['iUserId'] = $iUserId;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where( $mapMember )->orWhere( $mapStaff )->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'error_account:\n'.trans( 'web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }


        //隨機產生時效性驗證碼
        $verification = "";
        for ( $i = 0 ; $i < config( '_config.verification.limit' ) ; $i++ ) {
            if (rand( 0, 1 )) {
                $verification .= rand( 1, 9 );
            } else {
                $str_arr = config( '_parameter.str_arr' );
                $verification .= $str_arr [rand( 0, count( $str_arr ) - 1 )];
            }
        }

        $DaoMemberVerification = SysMemberVerification::query()->find( $DaoMember->iId );
        if ( !$DaoMemberVerification) {
            $DaoMemberVerification = new SysMemberVerification ();
            $DaoMemberVerification->iMemberId = $DaoMember->iId;
            $DaoMemberVerification->vVerification = $verification;
            $DaoMemberVerification->iStartTime = time();
            $DaoMemberVerification->iEndTime = $DaoMemberVerification->iStartTime + config( '_config.verification.time' );
            $DaoMemberVerification->iStatus = 0;
        } else {
            $DaoMemberVerification->vVerification = $verification;
            $DaoMemberVerification->iStartTime = time();
            $DaoMemberVerification->iEndTime = $DaoMemberVerification->iStartTime + config( '_config.verification.time' );
            $DaoMemberVerification->iStatus = 0;
        }

        if ($DaoMemberVerification->save()) {

            //Logs
            $this->_saveLogAction( $DaoMemberVerification->getTable(), $DaoMember->iId, 'The id forget password', json_encode( $DaoMemberVerification, JSON_UNESCAPED_UNICODE ) );


            Mail::send( '_email.forgot' ,
                [
                    'verification' => $verification ,
                    'url' => 'https://actualminer.herokuapp.com/'.$mail_url_lang.'verify-password',
                ] ,
                function( $message ) use ( $vAccount ) {
                    $message->to( $vAccount )->subject( trans( 'web_message.verification.forgot_password' ) );
            } );

            session()->put( 'verification.memberid', $DaoMember->iId );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( 'web_message.verification.success' );
            $this->rtndata ['verification'] = $verification;
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( 'web_message.verification.dail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     * 密碼重設
     */
    public function doResetPassword (Request $request )
    {
        $vAccount  = ( $request->exists( 'account' ) ) ? $request->input( 'account' ) : "";
        $vVerification = $request->exists( 'verification' ) ? $request->input( 'verification' ) : "";
        $vPasswordNew  = $request->exists( 'password' ) ? $request->input( 'password' ) : "";

        // null error
        $this->rtndata ['status'] = 0;
        if ($vAccount=='') $this->rtndata ['message'] = 'account is empty';
        elseif ($vVerification=='') $this->rtndata ['message'] = 'verification is empty';
        elseif ($vPasswordNew=='') $this->rtndata ['message'] = 'password is empty';


        $mapMember['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where($mapMember)->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'not find member:\n'.trans( 'web_message.verification.error' );
            return response()->json( $this->rtndata );
        }

        $mapMemberVerification['vVerification'] = $vVerification;
        $mapMemberVerification['iStatus'] = 0;
        $DaoMemberVerification = SysMemberVerification::query()
                ->where( $mapMemberVerification )
                ->where('iEndTime', '>', time() )
                ->find( $DaoMember->iId );

        if ( !$DaoMemberVerification)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'verification.error:\n'.trans( 'web_message.verification.error' );
            return response()->json( $this->rtndata );
        }


        $DaoMember->iUpdateTime = time();
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPasswordNew . $DaoMember->vUserCode );

        if ( $DaoMember->save() ) {
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'reset password for forget password', json_encode( $DaoMember, JSON_UNESCAPED_UNICODE ) );

            $DaoMemberVerification->iStatus = 1;
            $DaoMemberVerification->save();

            session()->flush();
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = 'resetpw.save_success:\n'.trans( 'web_message.save_success' );
//            $this->rtndata ['rtnurl'] = url( 'web/login' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'resetpw.save_fail:\n'.trans( 'web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     * API呼叫function
     */
    public function doRegister ( Request $request )
    {
        $vAccount  = ( $request->exists( 'account' ) ) ? $request->input( 'account' ) : "";
        $vPassword = ( $request->exists( 'password') ) ? $request->input( 'password' ) : "";
        $vBirthday = ( $request->exists( 'birthday') ) ? $request->input( 'birthday' ) : "";
        $vNationality = ( $request->exists( 'lang') ) ? $request->input( 'lang' ) : "";
        $mail_url_lang = ( $request->exists( 'mail_url_lang') ) ? $request->input( 'mail_url_lang' ) : "";  //導向目標語系網站

        // null error
        $this->rtndata ['status'] = 0;
        if ($vAccount=='') $this->rtndata ['message'] = 'account is empty';
        elseif ($vPassword=='') $this->rtndata ['message'] = 'password is empty';
        elseif ($vBirthday=='') $this->rtndata ['message'] = 'birthday is empty';
        elseif ($vNationality=='') $this->rtndata ['message'] = 'lang is empty';

        //帳號email格式錯誤，退回
        if ( !FuncController::_isValidEmail( $vAccount )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'register.error_account:\n'.trans( 'web_message.register.error_account' );
            return response()->json( $this->rtndata );
        }
        //帳號存在，退回
        $map ['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where( $map )->first();
        if ($DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'register.account_not_empty:\n'.trans( 'web_message.register.account_not_empty' );
            return response()->json( $this->rtndata );
        }


        $str = md5( uniqid( mt_rand(), true ) );
        $uuid = substr( $str, 0, 8 ) . '-';
        $uuid .= substr( $str, 8, 4 ) . '-';
        $uuid .= substr( $str, 12, 4 ) . '-';
        $uuid .= substr( $str, 16, 4 ) . '-';
        $uuid .= substr( $str, 20, 12 );
        do {
            $userid = rand( 1000000001, 1099999999 );
            $check = SysMember::query()->where( "iUserId", $userid )->first();
        } while ($check);

        //
        $date_time = time();
        $DaoMember = new SysMember ();
        $DaoMember->vAgentCode = config( '_config.agent_code' );
        $DaoMember->iUserId = $userid;
        $DaoMember->vUserCode = $uuid;
        $DaoMember->iAcType = 99;       //99一般使用者
        $DaoMember->vAccount = $vAccount;
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        $DaoMember->vCreateIP = $request->ip();
        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
        $DaoMember->bActive = 0;
        $DaoMember->iStatus = 1;
        $DaoMember->vEmail = FuncController::_isValidEmail( $vAccount ) ? $vAccount : '';
        if ($DaoMember->save()) {
            try {
                //註冊會員的詳情資料
                $DaoMemberInfo = new SysMemberInfo();
                $DaoMemberInfo->iMemberId = $DaoMember->iId;
                $DaoMemberInfo->vUserImage = "/images/empty.jpg";
                $DaoMemberInfo->vUserName = ($request->input('vUserName')) ? $request->input('vUserName') : '';
                $DaoMemberInfo->vNationality = $vNationality;
//            $DaoMemberInfo->vUserID =   ( $request->input( 'vUserID' ) )   ? $request->input( 'vUserID' ) : "";
                $DaoMemberInfo->iUserBirthday = strtotime($vBirthday);
//            $DaoMemberInfo->vUserEmail = FuncController::_isValidEmail( $vAccount ) ? $vAccount : '';
                $DaoMemberInfo->vUserContact = $request->input('vUserContact') ? $request->input('vUserContact') : "";
                $DaoMemberInfo->save();

                //註冊會員的群組,預設'5'的一般會員群組
                $DaoGroupMember = new SysGroupMember();
                $DaoGroupMember->iGroupId = 5;
                $DaoGroupMember->iMemberId = $DaoMember->iId;
                $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                $DaoGroupMember->iStatus = 1;
                $DaoGroupMember->save();

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = 'register success:\n'.trans('web_message.register.success') . trans('web_message.register.verification');
                $this->rtndata ['url'] = url('/api/auth/doActive') .'/'. $uuid;

                Mail::send('_email.welcome', ['url' => url('/api/auth/doActive') .'/'. $uuid .'?lang='.$mail_url_lang ], function ($message) use ($vAccount) {
                    $message->to($vAccount, '會員')->subject('Register Success!');
                });

                //api call
                FuncController::_addLog( 'Portal register' );

            } catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = $e->getMessage() .'\n'. trans( 'web_message.register.send_active' );
            }

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'register.save_fail:\n'.trans( 'web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     * 註冊成功，信箱驗證
     */
    public function doActive ( Request $request, $usercode )
    {
        $lang = ( $request->exists( 'lang') ) ? $request->input( 'lang' ) : "";     //目標語系

        $map['vUserCode'] = $usercode;
        $Dao = SysMember::query()->where( $map )->first();
        if ( !$Dao) {
            return View()->make( "errors.empty" );
        }
        if ($Dao->bActive) {
            return View()->make( "errors.active" );
        }
        $Dao->bActive = 1;
        $Dao->iUpdateTime = time();
        $Dao->save();

        //
        FuncController::_addLog( 'Portal doActive' );

//        return redirect( 'member_center/resetpw' );
        return redirect( 'https://actualminer.herokuapp.com/'.$lang.'login' );      //redirect to portal page
    }


    /*
     * View blade of account logout
     */
    public function logoutView (Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
//        session()->forget( 'shop_member' );
//        session()->forget( 'shop_member.iId' );
//        session()->forget( 'rtnurl' );
        return redirect()->guest( 'web/login' );
    }

    /*
     * logout process
     */
    public function doLogout ()
    {
        session()->flush();
        session()->regenerate();
//        session()->forget( 'shop_member' );
//        session()->forget( 'shop_member.iId' );
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( 'web_message.logout.success' );
        $this->rtndata ['rtnurl'] = url('web');
        return response()->json( $this->rtndata );
    }



    /*
     * get member information
     */
    public function getMemberInformation ( Request $request )
    {
        $id =  $request->exists( 'uid' ) ? $request->input( 'uid' ) : 0;
        if ( !$id ) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( 'web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }


        try {
            //會員資料
            $Dao = SysMemberInfo::query()
                ->join('sys_member', 'sys_member.iId', '=', 'sys_member_info.iMemberId')
                ->where('sys_member_info.iMemberId', '=', $id)
                ->select('sys_member.iId',
                    'sys_member.vAccount',
                    'sys_member.vPassword',
                    'sys_member.vWallet',
                    'sys_member_info.vUserName',
                    'sys_member_info.iUserBirthday',
                    'sys_member_info.vNationality',
                    'sys_member_info.vID'
                )
                ->first();
            if (!$Dao) {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = 'memberinfo.empty_id:\n' . trans('web_message.empty_id');
                return response()->json($this->rtndata);
            }

            $Dao->iUserBirthday = $Dao->iUserBirthday ? $Dao->iUserBirthday : 0;
            $Dao->iUserBirthday = date('Y-m-d', $Dao->iUserBirthday);
        }catch (\Exception $e){
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = $e->getMessage().':\n' . trans('web_message.empty_id');
            return response()->json($this->rtndata);
        }

        //Logs
        // $this->_saveLogAction( $Dao->getTable(), $id, 'api-getMemberInformation from '.$request->ip() , json_encode( $Dao ) );


        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = 'get member info success:\n';
        $this->rtndata ['data'] = json_encode( $Dao, JSON_UNESCAPED_UNICODE );
        return response()->json( $this->rtndata );
    }


    /*
     * ajax member save password for resetpassword
     */
    public function doSavePassword ( Request $request )
    {
        $uid = $request->input( 'uid' ) ? $request->input( 'uid' ) : "";
        $vPassword    = ( $request->exists( 'password' ) ) ? $request->input( 'password' ) : "";
        $vPasswordNew = ( $request->exists( 'passwordNew' ) ) ? $request->input( 'passwordNew' ) : "";

        // null error
        $this->rtndata ['status'] = 0;
        if ($uid=='') $this->rtndata ['message'] = 'uid is empty';
        elseif ($vPassword=='') $this->rtndata ['message'] = 'password is empty';
        elseif ($vPasswordNew=='') $this->rtndata ['message'] = 'passwordNew is empty';

        $DaoMember = SysMember::query()->find( $uid );
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'resetpw.account_not_empty:\n'.trans( 'web_message.register.account_not_empty' );
            return response()->json( $this->rtndata );
        }
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'resetpw.error_password:\n'.trans( 'web_message.login.error_password' );
            return response()->json( $this->rtndata );
        }

        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPasswordNew . $DaoMember->vUserCode );
        $DaoMember->iUpdateTime = time();

        if ($DaoMember->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = 'resetpw.success:\n'.trans( 'web_message.save_success' );
//            $this->rtndata ['rtnurl'] = url( 'login' );
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'api-edit-password from '.$request->ip(), json_encode( $DaoMember, JSON_UNESCAPED_UNICODE ) );
            session()->forget( 'shop_member' );
            session()->forget( 'shop_member.info' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( 'web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
    * ajax member save
    */
    public function doSave ( Request $request )
    {
        $vPassword = $request->exists( 'password' ) ? $request->input( 'password' ) : "";   //修改儲存會員資料需要密碼確認
        $id = $request->exists( 'uid' ) ? $request->input( 'uid' ) : 0;
        if ( !$id ) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( 'web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }

        //會員資料
        $Dao = SysMember::query()->where('iId', '=', $id)->first();
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'member.empty_id:\n'.trans( 'web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        
        if ($Dao->vPassword) {  //一般登入判斷密碼
            //密碼是否一樣
            if ($Dao->vPassword != hash( 'sha256', $Dao->vAgentCode . $vPassword . $Dao->vUserCode ))
            {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = 'error_password:\n'.trans( 'web_message.login.error_password' );
                return response()->json( $this->rtndata );
            }
        }else{  //社群登入，原來沒有密碼
            $Dao->vPassword = hash( 'sha256', $Dao->vAgentCode . $vPassword . $Dao->vUserCode );
        }
        //
        if ($request->exists( 'wallet' )) {
            $Dao->vWallet = $request->input( 'wallet' );
        }
        $Dao->iUpdateTime = time();   


        //
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'api-edit 1 from '.$request->ip(), json_encode( $Dao, JSON_UNESCAPED_UNICODE ) );

            $DaoMemberInfo = SysMemberInfo::query()->where('iMemberId', '=', $id)->first();
            //有參數再存入
            if ($request->exists( 'vUserName' )) {
                $DaoMemberInfo->vUserName = $request->input( 'vUserName' );
            }
            if ($request->exists( 'vUserNameE' )) {
                $DaoMemberInfo->vUserNameE = $request->input( 'vUserNameE' );
            }
            if ($request->exists( 'vUserTitle' )) {
                $DaoMemberInfo->vUserTitle = $request->input( 'vUserTitle' );
            }
            if ($request->exists( 'vUserID' )) {
                $DaoMemberInfo->vUserID = $request->input( 'vUserID' );
            }
            if ($request->exists( 'iUserBirthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'iUserBirthday' ) );
            }
            if ($request->exists( 'vUserEmail' )) {
                $DaoMemberInfo->vUserEmail = $request->input( 'vUserEmail' );
            }
            if ($request->exists( 'vUserContact' )) {
                $DaoMemberInfo->vUserContact = $request->input( 'vUserContact' );
            }
            if ($request->exists( 'lang' )) {
                $DaoMemberInfo->vNationality = $request->input( 'lang' );
            }
            if ($request->exists( 'birthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'birthday' ) );
            }
            if ($request->exists( 'username' )) {
                $DaoMemberInfo->vUserName = $request->input( 'username' );
            }
            if ($request->exists( 'vUserAddress' )) {
                $DaoMemberInfo->vUserAddress = $request->input( 'vUserAddress' );
            }
            $DaoMemberInfo->save();

            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'api-edit 2 from '.$request->ip(), json_encode( $DaoMemberInfo, JSON_UNESCAPED_UNICODE ) );

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( 'web_message.save_success' );
            //            $this->rtndata ['rtnurl'] = url( 'member_center' );
           
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'memberinfo.save_fail:\n'.trans( 'web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     * get member wallet all
     */
    public function getMemberWallet( Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';
        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            FuncController::_addLog( $request->ip() . 'error token for get member wallet.' );
            return response()->json( $this->rtndata );
        }

        $id =  $request->exists( 'id' ) ? $request->input( 'id' ) : 0;

        try {
            //會員資料
            $mapMember['iStatus'] = 1;
            if($id){
                $mapMember['iId'] = $id;
            }
            $select = ['vWallet'];
            $DaoMember = SysMember::query()->whereNotNull('vWallet')->where($mapMember)->select($select)->groupBy($select)->get();
            if ( !$DaoMember) {
                $this->rtndata ['status'] = 204;
                $this->rtndata ['message'] = 'no data !!' . trans('web_message.empty_id');
                return response()->json($this->rtndata);
            }

            $this->rtndata ['status'] = 200;
            $this->rtndata ['message'] = 'OK get member wallet success : ' . '資源成功獲取並於 message body 內發送';
            $this->rtndata ['data'] = json_encode( $DaoMember, JSON_UNESCAPED_UNICODE );

        }catch (\Exception $e){
            $this->rtndata ['status'] = 400;
            $this->rtndata ['message'] = $e->getMessage().':' . '發生未知或無法處理的錯誤。';
            return response()->json($this->rtndata);
        }

        return response()->json( $this->rtndata );
    }

    /*
     * get
     */
    public function getRevenueDaily( Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';
        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            FuncController::_addLog( $request->ip() . 'error token for get revenue daily.' );
            return response()->json( $this->rtndata );
        }

        $id =  $request->exists( 'id' ) ? $request->input( 'id' ) : 0;
        $vWallet =  $request->exists( 'wallet' ) ? $request->input( 'wallet' ) : 0;

        try {
            //排程資料
            $mapRevenueDaily['bShow'] = 1;
            if($id){
                $mapRevenueDaily['iId'] = $id;
            }
            if($vWallet){
                $mapRevenueDaily['vWallet'] = $vWallet;
            }
            $select = ['vWallet', 'vDate', 'vRevenue'];
            $DaoRevenueDaily = ModRevenueDaily::query()->where($mapRevenueDaily)->select($select)->orderBy('vDate','DESC')->get();
            if ( !$DaoRevenueDaily) {
                $this->rtndata ['status'] = 204 ;
                $this->rtndata ['message'] = 'no data !!' . trans('web_message.empty_id');
                return response()->json($this->rtndata);
            }

            $this->rtndata ['status'] = 200;
            $this->rtndata ['message'] = 'OK get revenue_daily success : ' . '資源成功獲取並於 message body 內發送';
            $this->rtndata ['data'] = json_encode( $DaoRevenueDaily, JSON_UNESCAPED_UNICODE );

        }catch (\Exception $e){
            $this->rtndata ['status'] = 400;
            $this->rtndata ['message'] = $e->getMessage().':' . '發生未知或無法處理的錯誤。';
            return response()->json($this->rtndata);
        }
        return response()->json( $this->rtndata );
    }

    /*
     * set
     */
    public function setRevenueDaily( Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';
        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            FuncController::_addLog( $request->ip() . 'error token for set revenue daily.' );
            return response()->json( $this->rtndata );
        }

        try {
            $vWallet = $request->exists( 'wallet' ) ? $request->input( 'wallet' ) : ''; 

            //
            // 相同的錢包id最多存10個, 超過10取代最舊的資料列
            //
            $mapRevenueDaily['bShow'] = 1;
            $mapRevenueDaily['vWallet'] = $vWallet;
            $select = ['vWallet', 'vDate', 'vRevenue'];
            $DaoRevenueDaily = ModRevenueDaily::query()->where($mapRevenueDaily)->select($select)->get();            
            if ( count($DaoRevenueDaily) < 10 ) {
                $DaoRevenueDaily = new ModRevenueDaily;
            } else {
                $DaoRevenueDaily = ModRevenueDaily::query()->where($mapRevenueDaily)->orderBy('vDate','ASC')->first();
            } 
            $DaoRevenueDaily->vWallet = $vWallet;
            $DaoRevenueDaily->vDate = $request->exists( 'date' ) ? $request->input( 'date' ) : '';
            $DaoRevenueDaily->vRevenue = $request->exists( 'revenue' ) ? $request->input( 'revenue' ) : '';
            $DaoRevenueDaily->iCreateTime = $DaoRevenueDaily->iUpdateTime = time();
            $DaoRevenueDaily->save();   

            //Logs
            $this->_saveLogAction( $DaoRevenueDaily->getTable(), $DaoRevenueDaily->iId, 'api-setData from '.$request->ip() , json_encode( $DaoRevenueDaily , JSON_UNESCAPED_UNICODE ) );

            $this->rtndata ['status'] = 200;
            $this->rtndata ['message'] = 'OK set revenue_daily success : ' . '資源成功獲取並於 message body 內發送';
            $this->rtndata ['data'] = json_encode( $DaoRevenueDaily->iId, JSON_UNESCAPED_UNICODE );

        } catch (\Exception $e) {
            $this->rtndata ['status'] = 400;
            $this->rtndata ['message'] = $e->getMessage().':' . '發生未知或無法處理的錯誤。';
            return response()->json($this->rtndata);
        }
        return response()->json( $this->rtndata, 201 );
    }



    /*
     * decide wallet 
     */
    public function inSysMemberWallet( Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';

        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            FuncController::_addLog( $request->ip() . 'error token for set revenue daily.' );
            return response()->json( $this->rtndata );
        }

        try {
            $vWallet = $request->exists( 'wallet' ) ? $request->input( 'wallet' ) : ''; 


            //
            // 有存在的錢包id 回傳true
            //
            $map['vWallet'] = $vWallet;
            $select = [];//['vWallet', 'vDate', 'vRevenue'];
            $Dao = SysMember::query()->where($map)->first();            
            if ( $Dao ) {
                $data = true;
                //
                if ($vWallet=='0x565fd3b3e4b5e3174c9fd18d67053dfeeb332628') {
                    $data = false;                    
                }
            } else {
                $data = false;
            } 

            //Logs
            // $this->_saveLogAction( $DaoRevenueDaily->getTable(), $DaoRevenueDaily->iId, 'api-setData from '.$request->ip() , json_encode( $DaoRevenueDaily , JSON_UNESCAPED_UNICODE ) );

            // $this->rtndata ['status'] = 200;
            $this->rtndata ['message'] = 'OK set revenue_daily success : ' . '資源成功獲取並於 message body 內發送';
            $this->rtndata ['data'] = $data;

        } catch (\Exception $e) {
            $this->rtndata ['status'] = 400;
            $this->rtndata ['message'] = $e->getMessage().':' . '發生未知或無法處理的錯誤。';
            return response()->json($this->rtndata);
        }
        return response()->json( $this->rtndata, 201 );
    }
}
