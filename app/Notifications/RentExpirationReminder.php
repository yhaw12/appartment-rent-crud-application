<?php

namespace App\Notifications;

use App\Models\Tennants;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RentExpirationReminder extends Notification
{
    use Queueable;
    public $tennants;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tennants $tenant)
    {
        $this->tennants = $tenant;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Rent Expiration Reminder for ' . $this->tennants->name)
                    ->line('Dear Landlord,')
                    ->line('This is a reminder that the rent for ' . $this->tennants->name . ' is due to expire on ' . $this->tennants->end_date->format('F j, Y') . '.')
                    ->action('View Tenant Details', url('/tennants' . $this->tennants->id))
                    ->line('Thank you for using our rental management system!');
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
