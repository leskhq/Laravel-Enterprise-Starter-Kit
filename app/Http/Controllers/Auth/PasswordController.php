<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\AuditRepository as Audit;
use App\Repositories\Criteria\User\UserWhereEmailEquals;
use App\Repositories\UserRepository as User;
use Flash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * @var User
     */
    protected $user;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user  = $user;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        $page_title = "Recover password";

        return view('auth.password', compact('page_title'));
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $email = $request->input('email');
        $user = $this->user->pushCriteria(new UserWhereEmailEquals($email))->all()->first();

        Audit::log(null, trans('passwords.audit-log.category'), trans('passwords.audit-log.msg-request-reset', ['email' => $email]));

        if (is_null($user)) {
            Flash::error( trans(Password::INVALID_USER) );
            return redirect()->back();
        }
        elseif ($user->auth_type !== 'internal') {
            Flash::error(trans('passwords.auth_type'));
            return redirect()->back();
        } else {

            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    Flash::success(trans($response));
                    return redirect()->back()->with('status', trans($response));

                case Password::INVALID_USER:
                    Flash::error( trans($response) );
                    return redirect()->back()->withErrors(['email' => trans($response)]);
            }
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $page_title = "Reset password";

        return view('auth.reset', compact('page_title'))->with('token', $token);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        Audit::log(null, trans('passwords.audit-log.category'), trans('passwords.audit-log.msg-reset-password', ['email' => $credentials['email']]));

        switch ($response) {
            case Password::PASSWORD_RESET:
                Flash::success(trans($response));
                return redirect($this->redirectPath());

            default:
                Flash::error(trans($response));
                return redirect()->back()
                    ->withInput($request->only('email'));
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        // Do not crypt the password here, the User model does it.
        $user->password = $password;

        $user->save();

        $user->emailPasswordChange();

        Auth::login($user);
    }

}
