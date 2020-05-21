<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any view services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any view services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('news', DB::table('news')->where('id', 1)->first());
    }
}