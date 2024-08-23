<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaidCourses extends Notification
{
    use Queueable;

    protected $message;
    protected $userId;
    protected $title;
    protected $ownerId;

    public function __construct($message, $userId, $title, $ownerId)
    {
        $this->message = $message;
        $this->userId = $userId;
        $this->title = $title;
        $this->ownerId = $ownerId;
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
            'owner_id' => $this->ownerId,
            'title' => $this->title,
        ];
    }
}
