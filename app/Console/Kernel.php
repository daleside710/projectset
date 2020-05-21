<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function () {
            DB::table('users')
                ->whereRaw('TIMESTAMPDIFF(MINUTE, created_at, NOW()) > 15')
                ->whereNull('phone_verified_at')
                ->delete();
        })->everyFifteenMinutes();

        $schedule->call(function () {
          $boxIsTimeCompleted = \App\Models\BoxOpen::whereIsOpened(0)->whereIsNotified(0)->orderBy('id', 'desc')->get();
          echo "Total boxes found: ".count($boxIsTimeCompleted);
          foreach($boxIsTimeCompleted as $boxOpen){
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $boxOpen->created_at);
            $to = \Carbon\Carbon::now();
            $diffInMinutes = $from->diffInMinutes($to);
            
            if ($diffInMinutes >= 1440){
              
              $user = User::find($boxOpen->user_id);
              
              if($user){
                if ($user->uuid) {
                  $user->notify(new SendNotification('Lykkeboks', 'Din daglige boks er klar til å bli åpnet :) ', url('/'), url('logo.png')));
                }
                Mail::to($user->email)->send(new SendFreeBoxMail($user->name, 'Din daglige boks er klar til å bli åpnet :)'));
              }
              $boxOpen->is_notified = 1;
              $boxOpen->save();
              
            }

          }            
            
        })->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
