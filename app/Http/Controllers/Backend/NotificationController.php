<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
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

    public function index()
    {
        return view('backend.pages.notification.index');
    }

    public function send(Request $request)
    {
        if ($request->has('notification_icon')) {

            $users = User::whereNotNULL('uuid')->get();
            $notification_icon = imageUpload($request->notification_icon, 'images/boxes');

            foreach ($users as $user) {
                try {
                    $user->notify(new SendNotification($request->title, $request->description, $request->url, url($notification_icon)));
                } catch (\Exception $ex) {
                }
            }
        }
        return redirect()->back()->with('success', 'Notifications sent successfully.');
    }
}