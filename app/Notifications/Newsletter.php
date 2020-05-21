<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Newsletter extends Notification
{
    use Queueable;
    protected $user, $subject, $description;

    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nyhetsvarsling | '.$this->subject)
            ->line($this->description)
            ->greeting('Hei ' . $this->user->name)
            ->action('Bruk rabattkoden', url('/'))
            ->line('Takk for besøket');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
