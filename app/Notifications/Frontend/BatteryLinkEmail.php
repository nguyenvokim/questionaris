<?php

namespace App\Notifications\Frontend;

use App\Models\Battery;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BatteryLinkEmail extends Notification
{
    use Queueable;

    public $client;
    public $battery;

    /**
     * Create a new notification instance.
     *
     * @param Client $client
     * @param Battery $battery
     */
    public function __construct(Client $client, Battery $battery)
    {
        $this->client = $client;
        $this->battery = $battery;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello ' . $this->client->first_name)
            ->line('We happy to send you the link for the test on our application')
            ->action('Link to Test', route('frontend.battery.clientBattery', ['batteryId' => $this->battery->id]))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
