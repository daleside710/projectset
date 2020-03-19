<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use File;
use Redirect;
use Response;
use Validator;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);
        return redirect()->to('/');
    }

    function createUser($getInfo, $provider)
    {
        $user = User::whereEmail($getInfo->email)->first();
        $date = date_create();
        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'phone_verified_at' => date_format($date, 'Y-m-d H:i:s')
//                'provider' => $provider,
//                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}