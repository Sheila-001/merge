<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $code;
    public $language;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $code, $language)
    {
        $this->subject = $subject;
        $this->code = $code;
        $this->language = $language;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.code');
    }
}
