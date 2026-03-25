<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Services\AfricasTalkingService;

class LowStockNotification extends Notification
{
    use Queueable;

    public $pump;
    public $attempted;
    public $remaining;

    public function __construct($pump, $attempted, $remaining)
    {
        $this->pump = $pump;
        $this->attempted = $attempted;
        $this->remaining = $remaining;
    }

    /**
     * Get the notification channels.
     */
    public function via($notifiable)
    {
        return ['mail', 'database']; // SMS is triggered manually
    }

    /**
     * EMAIL NOTIFICATION
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🚨 LOW STOCK ALERT')
            ->greeting('Attention Required!')
            ->line('Pump Name: ' . $this->pump->name)
            ->line('Remaining Stock: ' . $this->remaining . ' Litres')
            ->line('Attempted Sale: ' . $this->attempted . ' Litres')
            ->line('Please refill the pump immediately.')
            ->salutation('— Fuel Tracking System');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toArray($notifiable)
    {
        return [
            'pump' => [
                'name' => $this->pump->name,
                'id' => $this->pump->id,
            ],
            'remaining' => $this->remaining,
            'attempted' => $this->attempted,
        ];
    }

    /**
     * REAL SMS (Africa's Talking)
     */
    public function sendSms($phone)
    {
        $sms = new AfricasTalkingService();

        $message =
            "🚨 LOW STOCK ALERT\n" .
            "Pump: {$this->pump->name}\n" .
            "Remaining: {$this->remaining} L\n" .
            "Attempted: {$this->attempted} L\n" .
            "Action required.";

        $sms->send($phone, $message);
    }
}

