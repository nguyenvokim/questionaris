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
    public $emailFooter;
    public $emailHeadline;

    /**
     * Create a new notification instance.
     *
     * @param Client $client
     * @param Battery $battery
     */
    public function __construct(Client $client, Battery $battery, string $emailContent, string $emailFooter, string $emailHeadline)
    {
        $this->client = $client;
        $this->battery = $battery;
        $this->emailContent = $emailContent;
        $this->emailFooter = $emailFooter;
        $this->emailHeadline = $emailHeadline;
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
        $time = strtotime($this->client->birth_date);
        $code = $this->client->personal_code . '_' . date("Y-m-d", $time);
        $link = route('frontend.battery.clientBattery', [
            'batteryId' => $this->battery->id,
            'code' => \Crypt::encryptString($code),
        ]);


        return (new MailMessage)
            ->subject('Questionnaire(s) for Completion')
            ->greeting($this->emailHeadline)
            ->line(new HtmlString(nl2br($this->emailContent . "\n")))
            ->action('Link to Questionnaire(s)', $link)
            ->line(new HtmlString(nl2br($this->emailFooter)));
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
