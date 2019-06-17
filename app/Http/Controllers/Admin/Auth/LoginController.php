<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\LogLogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Validation\ValidationException;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin,admin')->except('logout');
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

    /** 登入失敗回傳錯誤 複寫 **/
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
            'password' => ['or password error.'],
        ]);
    }

    /** 登入成功 複寫 **/
    protected function sendLoginResponse(Request $request)
    {
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

            return redirect()->intended($this->redirectPath());
        }

//        return $this->authenticated($request, $this->guard()->user())?: redirect()->intended($this->redirectPath());
    }
}
