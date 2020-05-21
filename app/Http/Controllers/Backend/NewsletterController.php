<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Box;
use App\Notifications\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
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
        $users = User::all();
        $boxes = Box::all();
        return view('backend.pages.newsletter.index', compact('users', 'boxes'));
    }

    public function send(Request $request)
    {
        try {
            $userIds = $request->user_id;
            ini_set('max_execution_time', 0); // 0 = Unlimited
            if (count($userIds) > 0) {
                $users = User::whereIn('id', $userIds)->get();
                foreach ($users as $user) {
                    $user->notify(new Newsletter($user, $request->subject, $request->description));
                }
            }
            session()->flash('success', 'Newsletter sent successfully!');
        } catch (\Exception $ex) {
            session()->flash('danger', $ex->getMessage());
        }

        return redirect()->back();
    }
}