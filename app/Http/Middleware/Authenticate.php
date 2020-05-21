<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        $boxId = basename(url()->current());

        if (!$request->expectsJson() && (\Request::is('redeem/' . $boxId))) {
            return url('box/details/' . $boxId);
        } elseif (!$request->expectsJson()) {
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        if( !Auth::check() )
            return redirect()->to('/');

        if (Auth::check())
        {
            if (Auth::User()->is_banned === 1)
            {
                Auth::logout();
                session()->flush();
                return redirect()->to('/')->with('warning', 'Kontoen din er utestengt.');
            }
        }
        return $next($request);
    }
}
