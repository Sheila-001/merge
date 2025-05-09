<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Event;

class NewEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Event: ' . $this->event->title)
            ->line('A new event has been created that might interest you.')
            ->line('Event: ' . $this->event->title)
            ->line('Date: ' . $this->event->start_date->format('F j, Y g:i A'))
            ->line('Location: ' . $this->event->location)
            ->action('View Event', url('/student/dashboard'))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'title' => $this->event->title,
            'start_date' => $this->event->start_date,
            'location' => $this->event->location,
        ];
    }
} 