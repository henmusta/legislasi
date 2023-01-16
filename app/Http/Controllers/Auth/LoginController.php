<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\RedirectsUsers;
use App\Traits\ThrottlesLogins;
use App\Traits\ValidateLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  use ValidateLogin, RedirectsUsers, ThrottlesLogins;

  public function __construct()
  {
    $this->middleware('guest:henmus')->except('logout');
  }

  public function showLoginForm()
  {
    return view('auth.login');
  }

  public function login(Request $request)
  {
    $this->validateLogin($request);
    if (method_exists($this, 'hasTooManyLoginAttempts') &&
      $this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);
      $this->sendLockoutResponse($request);
    }

    $remember = $request->has('remember');

    $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $data = [
      $fieldType => $request['email'],
      'password' => $request['password']
    ];
    if (Auth::attempt($data, $remember)) {
      return redirect(RouteServiceProvider::DASHBOARD_PAGE);
    } else {
      $this->incrementLoginAttempts($request);
      $this->sendFailedLoginResponse($request);

      return redirect(RouteServiceProvider::LOGIN_PAGE);
    }
  }

  public function logout(Request $request)
  {
    // print_r(guard);
    if ($this->guard('henmus')->check()) {
      $redirect = redirect(RouteServiceProvider::LOGIN_PAGE);
    }
    $this->guard()->logout();
    $request->session()->invalidate();
    $request->session()->regenerate();
    return $redirect;
  }


}
