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
        $user = User::where('email', $request->email)->where('is_banned',1)->first();
        if ($user) {
            return response()->json(['success' => false, 'message' => 'Du har blitt utestengt grunnet:<br/>' . $user->banned_reason]);
        }

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
    }

    public function credentials(Request $request)
    {
        return array_merge($request->only('email', 'password'), ['is_banned' => 0]);
    }
}
