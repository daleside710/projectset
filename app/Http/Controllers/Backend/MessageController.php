<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Box;
use App\Notifications\Newsletter;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (Auth::user()->type === 1) {
                return redirect()->route('home')->with('warning', 'Denne siden er kun forbeholdt ledelsen.');
            }
            return $next($request);
        });
    }

    public function createMessage()
    {
        $smsData = User::where('phone','!=', null)->get();
        return view('backend.pages.sms.create', compact('smsData'));
    }

    public function sendMessage(Request $request)
    {
        try {

            $select_all = $request->post('select_all');
            $message = $request->post('message');

            if($select_all == "checked") {
                $smsData =  User::where('phone','!=', null)->get();
                foreach ($smsData as $sms) {
                    $messages = array(
                      array('to'=> trim($sms->phone), 'body'=> $message)
                    );
                    $response = send_sms($messages);
                }

            } else {

                $numbers = $request->post('phone');
                $phone_numbers = explode(',', $numbers);
                foreach ($phone_numbers as $number) {
                    $messages = array(
                      array('to'=> trim($number), 'body'=> $message)
                    );
                    $response = send_sms($messages);
                }
            }
            
            
           return redirect()->back()->with('success', 'Message sent successfully.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('danger', $e->getMessage());
        }

        return redirect()->back();
    }
}