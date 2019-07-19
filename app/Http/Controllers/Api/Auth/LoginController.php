<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Repositories\Member\MemberRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * @var \App\Repositories\Member\MemberRepository|string
     */
    protected $memberRepository;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberRepository $memberRepository)
    {
        //        $this->middleware('guest')->except('logout');
        $this->memberRepository = $memberRepository;
    }
    
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            
            return $this->sendLockoutResponse($request);
        }
        $member = $this->attemptLogin($request);
        if ($member) {
            return $this->sendLoginResponse($member);
        }
        
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }
    
    public function logout(Request $request)
    {
        return null;
    }
    
    //登入失敗
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['result' => '400', 'error_message' => '帳號密碼錯誤',], 200);
    }
    
    protected function sendLoginResponse($member)
    {
        $api_token         = str_random(64);
        $member->api_token = $api_token;
        $member->save();
        
        return response()->json([
            'result'    => '200',
            'api_token' => $api_token,
            'member'    => $member,
        ], 200);
    }
    
    //    protected function loggedOut(Request $request)
    //    {
    //    }
    
    protected function attemptLogin(Request $request)
    {
        $member = $this->memberRepository->getMemberByEmail($request->email);
        if ($member) {
            if (Hash::check($request->password, array_get($member, 'password'))) {
                return $member;
            }
        }
        return false;
    }
    
    //嘗試登入五次失敗，鎖住該帳號 60 秒
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        
        return response()->json(['result' => '400', 'error_message' => '嘗試登入五次失敗，稍後在登入'], 200);
    }
    
    protected function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            $this->username() => 'required|email|string',
            'password'        => 'required|string',
        ]);
        
        if ($validator->fails()) {
            
            throw new HttpResponseException(response()->json([
                'result'        => '422',
                'error_message' => $validator->errors(),
            ]));
        }
    }
}
