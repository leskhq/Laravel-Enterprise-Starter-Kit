<?php namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidConfirmationCodeException;
use App\Http\Controllers\Controller;
use App\Repositories\AuditRepository as Audit;
use App\User;
use Auth;
use Flash;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Redirect;
use Setting;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        return $user;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {

        $this->validate($request, [
            'username' => 'required|min:3|max:255',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {

            $user = Auth::user();
            // Allow only if user is root or enabled.
            if ( ('root' == $user->username) || ($user->enabled) )
            {
                Audit::log(Auth::user()->id, trans('general.audit-log.category-login'), trans('general.audit-log.msg-login-success', ['username' => $user->username]));

                Flash::success("Welcome " . Auth::user()->first_name);
                return redirect()->intended($this->redirectPath());
            }
            else
            {
                Audit::log(null, trans('general.audit-log.category-login'), trans('general.audit-log.msg-forcing-logout', ['username' => $credentials['username']]));

                Auth::logout();
                return redirect(route('login'))
                    ->withInput($request->only('username', 'remember'))
                    ->withErrors([
                        'username' => trans('admin/users/general.error.login-failed-user-disabled'),
                    ]);
            }
        }

        Audit::log(null, trans('general.audit-log.category-login'), trans('general.audit-log.msg-login-failed', ['username' => $credentials['username']]));

        return redirect($this->loginPath())
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        $page_title = "Login";

        return view('auth.login', compact('page_title'));
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $page_title = "Register";

        return view('auth.register', compact('page_title'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $username = "N/A";
        if ($request->has('username')) {
            $username = $request['username'];
        }
        Audit::log(null, trans('general.audit-log.category-register'), trans('general.audit-log.msg-registration-attempt', ['username' => $username]));

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        Audit::log(null, trans('general.audit-log.category-register'), trans('general.audit-log.msg-account-created', ['username' => $user->username]));

        if (Setting::get('auth.enable_user_on_create')) {
            $user->enabled = true;
            $user->save();
            Audit::log(null, trans('general.audit-log.category-register'), trans('general.audit-log.msg-account-enabled', ['username' => $user->username]));
        }

        $user->emailValidation();

        if ($user->enabled) {
            Flash::success("Welcome " . $user->first_name . ", your account has been created");
            Auth::login($user);
            $request->flashExcept(['password', 'password_confirmation']);
            return redirect($this->redirectPath());
        } else {
            if (Setting::get('auth.email_validation')) {
                Flash::success("Welcome " . $user->first_name . ", your account has been created, an email has been sent to your address to complete the registration process.");
                $request->flashExcept(['password', 'password_confirmation']);
                return redirect(route('confirm_emailPost'));
            } else {
                Flash::success("Welcome " . $user->first_name . ", your account has been created, and will soon be enabled.");
                $request->flashExcept(['password', 'password_confirmation']);
                return redirect(route('home'));
            }
        }

    }

    public function verify($confirmation_code, Request $request)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        Audit::log(null, trans('general.audit-log.category-register'), trans('general.audit-log.msg-email-validated', ['username' => $user->username]));

        if (Setting::get('auth.enable_user_on_validation')) {
            $user->enabled = true;
            Audit::log(null, trans('general.audit-log.category-register'), trans('general.audit-log.msg-account-enabled', ['username' => $user->username]));
        }

        $user->save();

        Flash::message(trans('general.status.email-validated'));

        $request->session()->reflash();
        return Redirect::route('home');
    }

    public function getVerify()
    {
        $page_title = "Verify email";

        return view('auth.verify', compact('page_title'));
    }

    public function postVerify(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|size:30',
        ]);

        $token = $request['token'];

        return $this->verify($token, $request);
    }

}
