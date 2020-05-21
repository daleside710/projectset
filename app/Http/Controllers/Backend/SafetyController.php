<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SafetyController extends Controller
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
        $safety = DB::table('safety')
                ->where('id', 1)
                ->first();

        return view('backend.pages.safety.edit', compact('safety'));
    }


    public function update(Request $request)
    {
        try {
            DB::table('safety')
                ->where('id', 1)
                ->update([
                    'content' => $request->safety
                ]);

            return redirect()->back()->with('success', 'Safety page updated successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('danger', $e->getMessage());

        }
    }
}