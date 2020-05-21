<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\OneSignal\OneSignalChannel;
use NotificationChannels\OneSignal\OneSignalMessage;

class SendNotification extends Notification
{
    use Queueable;
    protected $title, $description, $url, $icon;
    /**
     * Create a new notification instance.
     *
     * @param $title
     * @param $description
     * @param $url
     * @param $icon
     */
    public function __construct($title, $description, $url, $icon)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->icon = $icon;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [OneSignalChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return OneSignalMessage
     */
    public function toOneSignal($notifiable)
    {
        return OneSignalMessage::create()
            ->setSubject($this->title)
            ->setBody($this->description)
            ->setUrl($this->url)
            ->setIcon($this->icon);
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
