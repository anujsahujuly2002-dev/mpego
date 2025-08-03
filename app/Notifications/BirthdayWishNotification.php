<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayWishNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $user,$token,$giftCardScratch;
    public function __construct($user,$token,$giftCardScratch)
    {
        $this->user = $user;
        $this->token = $token;
        $this->giftCardScratch = $giftCardScratch;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        // dd("Test");
        return (new MailMessage)->subject('Happy Birthday!')->view('emails.birthday',['user'=>$this->user,'giftCardScratch'=>$this->giftCardScratch,'token'=>$this->token]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Happy Birthday!',
            'body'  => 'Wishing you a birthday filled with laughter, love, and lasting memories. May this year bring new adventures and endless success!',
        ];
    }
}
