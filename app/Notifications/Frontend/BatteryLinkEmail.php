<?php

namespace App\Notifications\Frontend;

use App\Models\Battery;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class BatteryLinkEmail extends Notification
{
    use Queueable;

    public $client;
    public $battery;
    public $emailContent;

    /**
     * Create a new notification instance.
     *
     * @param Client $client
     * @param Battery $battery
     */
    public function __construct(Client $client, Battery $battery, string $emailContent)
    {
        $this->client = $client;
        $this->battery = $battery;
        $this->emailContent = $emailContent;
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
            ->subject('Questionnaire(s) for Completion')
            ->greeting('Hello ' . $this->client->first_name)
            ->line(new HtmlString(nl2br($this->emailContent)))
            ->action('Link to Questionnaire(s)', route('frontend.battery.clientBattery', ['batteryId' => $this->battery->id]))
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
