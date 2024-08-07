<?php

namespace App\Notifications;

use App\Models\Auth\User;
use App\Models\UserInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InviteUserEmail extends Notification
{
    use Queueable;

    public $userInvite;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(UserInvite $userInvite)
    {
        $this->userInvite = $userInvite;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $link = route('frontend.auth.register', [
            'code' => $this->userInvite->invite_key,
        ]);
        $inviter = User::find($this->userInvite->inviter_id);
        return (new MailMessage)
            ->subject('GoMetrics invitation!')
            ->greeting('Hi ' . $this->userInvite->first_anme . ',')
            ->line($inviter->first_name . ' has invited you to collaborate with them. Use the button below to set up your account and get started:')
            ->action('Register', $link)
            ->salutation('Welcome aboard,');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
