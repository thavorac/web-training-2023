<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private $activateLink)
    {
        //
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Otp Mail',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.otp_mail',
            with:['activateLink'=>$this->activateLink],
        );
    }
    public function attachments(): array
    {
        return [];
    }
}