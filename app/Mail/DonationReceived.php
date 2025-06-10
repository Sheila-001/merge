<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $donation; // Added property to store donation data

    /**
     * Create a new message instance.
     */
    public function __construct($donation)
    {
        $this->donation = $donation; // Store the donation data
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for your donation!', // Updated subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.donation_received', // Updated view name
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Can be modified to include attachments if needed
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Thank you for your donation!')
                    ->view('emails.donation_received')
                    ->with(['donation' => $this->donation]); // Pass donation data to the view
    }
}
