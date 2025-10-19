<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\OTP;

class TwoStepVerification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $otp;
    public function __construct(OTP $otp)
    {
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Admin Panel - Two Step Verification Code')
                    ->greeting('Hello!')
                    ->line('Your OTP code is: '.$this->otp->code.' and it will expire in 10 minutes')
                    ->line('Please do not share this code with anyone.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
