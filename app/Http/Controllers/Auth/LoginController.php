<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // 支持的登录字段
    protected $supportFields = ['name', 'email'];

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo()
    {
        return route('profile', auth()->user());
    }

    // 将支持的登录字段都传递到 UserProvider 进行查询
    public function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        foreach ($this->supportFields as $field) {
            if (empty($credentials[$field])) {
                $credentials[$field] = $credentials[$this->username()];
            }
        }

        return $credentials;
    }
}
