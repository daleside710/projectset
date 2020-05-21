<?php

namespace App\Http\Controllers\Backend;

use Auth;
use DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
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

    public function settings()
    {
        $settingsData = DB::table('settings')->get();
        $settings = [];

        foreach ($settingsData as $setting) {
            $settings[$setting->name] = $setting->value;
        }

        return view('backend.pages.settings.index', compact('settings'));
    }
    
    public function updateSettings(Request $request)
    {
        try {
            DB::table('settings')
                ->where('name', 'stripe_public_key')
                ->update([
                    'value' => $request->stripe_public_key
                ]);
            DB::table('settings')
                ->where('name', 'stripe_secret_key')
                ->update([
                    'value' => $request->stripe_secret_key
                ]);
            return redirect()->back()->with('success', 'Seettings updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }
    }
}
