<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\CoinController;
use App\Http\Controllers\FuncController;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends _PortalController
{
    /*
     *
     */
    public function index ()
    {
        $this -> module = [ 'register' ];
        $this -> _init();

        return $this->view;
    }

    /*
     *
     */
    public function doRegister ( Request $request )
    {
        $vAccount  = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "";
        $vPassword = ( $request->exists( 'vPassword') ) ? $request->input( 'vPassword' ) : "";

        //帳號email格式錯誤，退回
        if ( !FuncController::_isValidEmail( $vAccount )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
            return response()->json( $this->rtndata );
        }

        //帳號存在，退回
        $map ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $map )->first();
        if ($DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.account_not_empty' );
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
            $check = SysMember::where( "iUserId", $userid )->first();
        } while ($check);

        //
        $date_time = time();
        $DaoMember = new SysMember ();
        $DaoMember->vAgentCode = config( '_config.agent_code' );
        $DaoMember->iUserId = $userid;
        $DaoMember->vUserCode = $uuid;
        $DaoMember->iAcType = 999; //
        $DaoMember->vAccount = $vAccount;
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        $DaoMember->vCreateIP = $request->ip();
        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
        $DaoMember->bActive = 0;
        $DaoMember->iStatus = 1;
        if ($DaoMember->save()) {
            //註冊會員的詳情資料
            $DaoMemberInfo = new SysMemberInfo();
            $DaoMemberInfo->iMemberId = $DaoMember->iId;
            $DaoMemberInfo->vUserImage = "/images/empty.jpg";
            $DaoMemberInfo->vUserName = ( $request->exists( 'vUserName' ) ) ? $request->input( 'vUserName' ) : $vAccount;
            $DaoMemberInfo->vUserID =   ( $request->exists( 'vUserID' ) )   ? $request->input( 'vUserID' ) : "";
            $DaoMemberInfo->iUserBirthday = time();
            $DaoMemberInfo->vUserEmail = $vAccount;
            $DaoMemberInfo->vUserContact = ( $request->exists( 'vUserContact' ) ) ? $request->input( 'vUserContact' ) : "";
            $DaoMemberInfo->save();

            //註冊會員的群組,預設5
            $DaoGroupMember = new SysGroupMember();
            $DaoGroupMember->iGroupId = 5;
            $DaoGroupMember->iMemberId = $DaoMember->iId;
            $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
            $DaoGroupMember->iStatus = 1;
            $DaoGroupMember->save();

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.register.success' ).trans( '_web_message.register.verification' );
            $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'login' );

            Mail::send( '_template_email.welcome' , [ 'url' => url( 'doActive' ) . '/' . $uuid ], function( $message ) use ( $vAccount ) {
                $message->to( $vAccount, '會員' )->subject( 'Register Success!' );
            } );

            //
            //CoinController::_CheckActivityRegister( $DaoMember->iId );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doActive ( $usercode )
    {
        $map['vUserCode'] = $usercode;
        $Dao = SysMember::where( $map )->first();
        if ( !$Dao) {
            return View()->make( "errors.empty" );
        }
//        if ($Dao->bActive) {
//            return View()->make( "errors.active" );
//        }
        $Dao->bActive = 1;
        $Dao->iUpdateTime = time();
        $Dao->save();

        return redirect( 'member_center/resetpw' );
    }
}
