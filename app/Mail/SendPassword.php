<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $contra;

    public function __construct($contra)
    {
        $this->contra = $contra;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Send Password',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mails.enviar_correo',
        );
    }

    public function attachments()
    {
        return [];
    }
}
