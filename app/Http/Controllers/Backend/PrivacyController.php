<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyController extends Controller
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

    public function edit()
    {
        $privacy = DB::table('privacy')
                ->where('id', 1)
                ->first();

        return view('backend.pages.privacy.edit', compact('privacy'));
    }


    public function update(Request $request)
    {
        try {
            DB::table('privacy')
                ->where('id', 1)
                ->update([
                    'content' => $request->privacy
                ]);

            return redirect()->back()->with('success', 'Privacy Policy page updated successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('danger', $e->getMessage());

        }
    }
}