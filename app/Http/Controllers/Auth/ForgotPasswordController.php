<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {

        return redirect('/#forgotPasswordModal');
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return back()->with('info', trans($response));
    }

    public function sendResetLinkEmail(Request $request)
    {
        try {
            
            if ($request->has('email')) {
                $user = User::whereEmail($request->email)->first();
                if (!$user) {
                    return response()->json(['success' => false ,'message' => 'Ugyldig e-postadresse.']);
                }
            }

            $response = $this->broker()->sendResetLink($this->credentials($request));

            return $response == Password::RESET_LINK_SENT
                ? response()->json(['success' => true ,'message' => 'Du vil om kort tid få tilsendt en e-post hvor du kan tilbakestille passordet ditt.'])
                : ['success' => false ,'message' => 'Noe gikk galt, prøv på nytt igjen senere.'];

        } catch (\Exception $ex) {
            return response()->json(['success' => true ,'message' => $ex->getMessage()]);
        }
    }

}
