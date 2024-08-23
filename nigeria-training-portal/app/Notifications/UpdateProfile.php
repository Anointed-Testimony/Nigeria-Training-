<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateProfile extends Notification
{
    use Queueable;

    protected $message;
    protected $userId;
    protected $title;

    public function __construct($message, $userId, $title)
    {
        $this->message = $message;
        $this->userId = $userId;
        $this->title = $title;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'user_id' => $this->userId,
            'title' => $this->title,
        ];
    }
}
