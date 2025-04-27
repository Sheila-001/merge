<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationReceived extends Mailable
{
    use Queueable, SerializesModels;

    // Public properties are automatically available in the view
    public $applicantName;
    public $trackingCode;

    /**
     * Create a new message instance.
     * 
     * @param string $applicantName
     * @param string $trackingCode
     * @return void
     */
    public function __construct(string $applicantName, string $trackingCode)
    {
        $this->applicantName = $applicantName;
        $this->trackingCode = $trackingCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Scholarship Application Received', // Set the email subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Point to the email view we will create
        return new Content(
            view: 'emails.application_received', 
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
