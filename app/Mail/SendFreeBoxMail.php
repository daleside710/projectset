<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendFreeBoxMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $content;

    /**
     * Create a new message instance.
     *
     * @param $name
     * @param $content
     */
    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return SendFreeBoxMail
     */
    public function build()
    {
        return $this->view("frontend.pages.free-box-email")->with(['name' => $this->name, 'content' => $this->content]);
    }
}