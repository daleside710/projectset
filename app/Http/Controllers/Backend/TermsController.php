<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsController extends Controller
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
        $terms = DB::table('terms')
                ->where('id', 1)
                ->first();

        return view('backend.pages.terms.edit', compact('terms'));
    }


    public function update(Request $request)
    {
        try {
            DB::table('terms')
                ->where('id', 1)
                ->update([
                    'content' => $request->terms
                ]);

            return redirect()->back()->with('success', 'Terms page updated successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('danger', $e->getMessage());

        }
    }
}