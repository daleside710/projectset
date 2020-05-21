<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    protected $subject, $description;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param $subject
     * @param $description
     */
    public function __construct(User $user, $subject, $description)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->description = $description;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new Newsletter($this->subject, $this->description));
    }
}
