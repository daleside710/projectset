<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use http\Client\Curl\User;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return redirect('/#loginModal');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {   
        $user = User::where('email', $request->email)->where('phone_verified_at','!=', null)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Ugyldig e-postadresse eller passord.']);
        }
    
        if ($this->attemptLogin($request)) {

            $redirectUrl = '';
            if( $user->type === 2 || $user->type === 3 ){
                $redirectUrl = 'admin/analytics';
            } else {
                $redirectUrl = '';
            }

            return response()->json(['success' => true, 'message' => 'Innlogging vellykket!', 'redirectUrl' => $redirectUrl]);
        } else {
            return response()->json(['success' => false, 'message' => 'Ugyldig e-postadresse eller passord.']);
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
}
