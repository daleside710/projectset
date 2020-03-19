<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactEmailController extends Controller
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
        $contactEmails = ContactEmail::orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.mail.index', compact('contactEmails'));
    }

    public function sendReply(Request $request)
    {
        try {
            $email = $request->email;
            $content = $request->message;
            $subject = $request->subject;
            Mail::send('backend.pages.reply-email', ['content' => $content], function ($message) use ($email, $subject) {
                $message->from('support@lykkeboks.no', 'Lykkeboks');
                $message->to($email);
                $message->subject($subject);
            });
            $contactEmail = ContactEmail::whereId($request->id)->first();
            $contactEmail->is_replied = 1;
            $contactEmail->save();
            session()->flash('success', 'Email sent successfully.');
        } catch (\Exception $ex) {
            session()->flash('danger', $ex->getMessage());
        }
        return redirect()->back();
    }
}
