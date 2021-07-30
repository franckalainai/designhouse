<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword as Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(config('app.client_url') . '/password/reset/' . $this->token) .
            '?email=' . urlencode($notifiable->email);

        return (new MailMessage)
            ->line('You are receiving this email because we received a password request for your account ')
            ->action('Reset password', $url)
            ->line('If you did not request a password reset, no furthure action is required');
    }
}
