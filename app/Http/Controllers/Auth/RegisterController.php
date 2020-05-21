<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'min:10','max:15', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->messages()->toArray(), 'status' => true], 200);
            } else {
                $user = $this->create($request->all());
                $code = $user->verification_code;
                $phone = $user->phone;

                if (!empty($code)) {
                    $messages = array(
                      array('to'=> $phone, 'body'=> 'Takk for at du opprettet en konto hos oss. Verifiseringskoden for kontoen din er: '.$code.'.')
                    );
                    $response = send_sms($messages);
                }

                // redirect
                // $this->guard()->login($user);
                Session::put('user_detail', $user);
                return response()->json(['message' => 'Du har blitt plukket ut til en tilfeldig kontroll. Vennligst vent mens du videresendes...', 'status' => true], 200);
            }
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'status' => false], 200);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $code = random_int(100000, 999999);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'verification_code' => $code,
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * showRegisterForm functionDescrtion
     * @return
     */
    public function showRegistrationForm()
    {
        return view('frontend.pages.auth.register');
    }
    
}
