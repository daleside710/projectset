<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
}
