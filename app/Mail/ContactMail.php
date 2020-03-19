<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email1;
    public $content;

    /**
     * Create a new message instance.
     *
     * @param $email
     * @param $content
     */
    public function __construct($email1, $content)
    {
        $this->email1 = $email1;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return ContactMail
     */
    public function build()
    {
        return $this->view("frontend.pages.contact-email")->with(['email' => $this->email1, 'content' => $this->content]);
    }
}
