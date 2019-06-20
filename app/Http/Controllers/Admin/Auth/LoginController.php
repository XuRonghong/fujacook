<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\LogLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Validation\ValidationException;
use Cookie;

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
    protected $redirectTo = 'admin';


    protected $maxAttempts = 5; // Default is 5
    protected $decayMinutes = 1; // Default is 1

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest:admin,admin')->except('logout');
    }

    public function redirectTo()
    {
        return 'admin/';
    }

    public function username()
    {
        return 'account';
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /** 登出 複寫 **/
    public function logout(Request $request)
    {
        $this->guard()->logout();
//        $request->session()->invalidate();
        return redirect('/admin');
    }

    /** 登入驗證 複寫 **/
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password', 'active');
    }

    /** 登入失敗回傳錯誤 複寫 **/
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.account.error') .' or 帳號未啟用'],
            'password' => ['or password error.'],
        ]);
    }

    /** 登入成功 複寫 **/
    protected function sendLoginResponse(Request $request)
    {
        // 设置记住我的时间为60分钟
        $rememberTokenExpireMinutes = 60;

        // 首先获取 记住我 这个 Cookie 的名字, 这个名字一般是随机生成的,
        // 类似 remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d
        $rememberTokenName = Auth::getRecallerName();

        // 再次设置一次这个 Cookie 的过期时间
        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);


        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($this->authenticated($request, $this->guard()->user())) {
            return null;
        } else {
            //紀錄登入log
            $user_id = $this->guard()->user()->id;
            $log_login = new LogLogin();
            $log_login->user_id = $user_id; //session( 'store.iId', 0 );
            $log_login->user_type = Admin::query()->find($user_id)->type;
            $log_login->action = 'admin login';
            $log_login->ip = $request->ip();
            $log_login->save();

            // set the remember me cookie if the user check the box
            $remember = ($request->filled('remember')) ? true : false;
            //記得我
            if ($remember) {
                setcookie('admin_us', $request->input('account'), time()+60*60);
                setcookie('admin_pw', $request->input('password'), time()+60*60);
            } else {
                setcookie('admin_us', $request->input('account'), time()+1);
                setcookie('admin_pw', $request->input('password'), time()+1);
            }

            return redirect()->intended($this->redirectPath());
        }

//        return $this->authenticated($request, $this->guard()->user())?: redirect()->intended($this->redirectPath());
    }
}
