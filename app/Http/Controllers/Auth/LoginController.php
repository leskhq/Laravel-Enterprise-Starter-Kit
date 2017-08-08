<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLogin;
use App\Events\UserLogout;
use App\Http\Controllers\Controller;
use Flash;
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

    // Hack to have the username as a required field in the validator.
    // See https://laravel.com/docs/5.4/authentication#included-authenticating
    public function username()
    {
        return 'username';
    }

    // Overrides method to fire event.
    protected function authenticated(Request $request, $user)
    {
        flash()->success( "Hello " . $user->first_name . "." );

        event(new UserLogin($user));

        return redirect()->intended($this->redirectPath());
    }

    // Overrides method to fire event.
    public function logout(Request $request)
    {
        // Grab current user and fire event.
        $user = auth()->user();
        event(new UserLogout($user));

        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

}
