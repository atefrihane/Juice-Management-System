<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public function __construct($groups)
    {

    }

    /**
     * Get the notification's delivery channelpuses.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            "message" => "test",
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            "message" => "test",
        ]);
    }
}
