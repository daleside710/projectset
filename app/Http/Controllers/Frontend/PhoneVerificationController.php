<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use DB;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class PhoneVerificationController extends Controller
{
    use RegistersUsers;

	public function verificationForm(){
		return redirect('/#verificationModal');
	}

    public function verification(Request $request)
    {
        $user_detail = Session::get('user_detail');
        $code = (int) $request->code;
		if (isset($user_detail->verification_code) && $user_detail->verification_code === $code) {
            $date = date_create();
            $result = DB::table('users')->where('id', $user_detail->id)->update(['phone_verified_at' => date_format($date, 'Y-m-d H:i:s'), 'verification_code' => null]);
            $this->guard()->login($user_detail);
            Session::forget('user_detail');
            return response()->json(['message' => 'Kontoverifisering vellykket!', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Du har tastet inn en ugyldig verifiseringskode.', 'status' => false], 200);
        }  
	}


    public function resetPassword(Request $request) {

        $phone = $request->phone;
        $code = random_int(100000, 999999);
        $result = DB::table('users')->where('phone', $phone)->update(['reset_password_verification_code' => $code]);
        $user = User::where('phone', $phone)
            ->first();
        if(!empty($user)) {
            Session::put('reset_password_detail', $user);
            $messages = array(
              array('to'=> $phone, 'body'=> 'Verifiseringskoden for kontoen din er: '.$code.'.')
            );
            $response = send_sms($messages);
            return response()->json(['message' => 'Du har fått tilsendt en verifiseringskode.', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Dette mobilnummeret eksisterer ikke i vår database.', 'status' => false], 200);
        }
    }

    public function resetForgotPassword(Request $request) {
        $user_detail = Session::get('reset_password_detail');
        $code = $request->code;
        if (isset($user_detail->reset_password_verification_code) && $user_detail->reset_password_verification_code === $code) {
            $date = date_create();
            $result = DB::table('users')->where('id', $user_detail->id)->update(['phone_verified_at' => date_format($date, 'Y-m-d H:i:s'),'reset_password_verification_code' => null]);
            return response()->json(['message' => 'Success', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Verifiseringskode ikke funnet i vår database.', 'status' => false], 200);
        }
    }

    public function updatePassword(Request $request) {
        $user_detail = Session::get('reset_password_detail');
         try {
           $validator = Validator::make($request->all(), [
                'password'         => 'required|min:8',
                'confirm_password' => 'required|min:8|same:password'
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()->toArray(), 'status' => true], 200);
            } else {
                $result = DB::table('users')->where('id', $user_detail->id)->update(['password' => Hash::make($request->password)]);
                $this->guard()->login($user_detail);    
                Session::forget('reset_password_detail');          
                return response()->json(['message' => 'Passordet ditt har blitt oppdatert.', 'status' => true], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'status' => false], 200);
        }
    }

    public function resendPasswordVerificationCode(Request $request) {
        $user_detail = Session::get('reset_password_detail');
        $code = random_int(100000, 999999);
        $messages = array(
          array('to'=> $user_detail->phone, 'body'=> 'Verifiseringskoden for kontoen din er: '.$code.'.')
        );
        $result = DB::table('users')->where('id', $user_detail->id)->update(['reset_password_verification_code' => $code]);
        $response = send_sms($messages);
        $user = User::where('id', $user_detail->id)
            ->first();
        Session::forget('reset_password_detail');    
        Session::put('reset_password_detail', $user);
        if($response) {
            return response()->json(['message' => 'Du har fått tilsendt en ny verifiseringskode.', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Noe gikk galt, vennligst prøv på nytt igjen senere.', 'status' => false], 200); 
        }
        
    }

    public function resendPhoneVerificationCode(Request $request) {
        $user_detail = Session::get('user_detail');
        $code = random_int(100000, 999999);
        $messages = array(
          array('to'=> $user_detail->phone, 'body'=> 'Verifiseringskoden for kontoen din er: '.$code.'.')
        );
        $result = DB::table('users')->where('id', $user_detail->id)->update(['verification_code' => $code]);
        $response = send_sms($messages);
        $user = User::where('id', $user_detail->id)
            ->first();
        Session::forget('user_detail');    
        Session::put('user_detail', $user);
        if($response) {
            return response()->json(['message' => 'Du har fått tilsendt en ny verifiseringskode.', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Noe gikk galt, vennligst prøv på nytt igjen senere.', 'status' => false], 200); 
        }
        
    }

 }