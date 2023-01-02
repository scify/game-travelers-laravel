<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification {
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected User $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject(__('notifications.registration_subject'))
            ->greeting(__('notifications.registration_greeting'))
            ->line('<div style="text-align:center; height: 200px;"><img class="badgeImg" style="height: 200px; margin-bottom: 0;" src='
                . asset('images/modes/mode-double.png') . ' alt="Game image"></div>')
            ->action(__('notifications.registration_prompt') . '!', route('home'))
            ->line(__('notifications.registration_end'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }
}
