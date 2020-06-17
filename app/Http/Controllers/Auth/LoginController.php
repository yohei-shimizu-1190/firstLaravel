<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite; // 追加！
use Illuminate\Http\Request; // 追加！

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
  protected $redirectTo = '/home';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  /**
   * GitHubの認証ページヘユーザーをリダイレクト
   *
   * @return \Illuminate\Http\Response
   */
  public function redirectToProvider() // 追加！
  {
    return Socialite::driver('github')->scopes(['read:user', 'public_repo'])->redirect();
  }

  /**
   * GitHubからユーザー情報を取得
   *
   * @return \Illuminate\Http\Response
   */
  public function handleProviderCallback(Request $request) // 追加！
  {
    $user = Socialite::driver('github')->user();

    $request->session()->put('github_token', $user->token);
    return redirect('github');
  }
}
