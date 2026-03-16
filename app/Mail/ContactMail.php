<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_contact;

    /**
    * Create a new message instance.
    */
    public function __construct($user_contact)
    {
        $this->user_contact = $user_contact;
    }
    
    /**
    * Get the message envelope.
    */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@coders_ninja.it', 'No-reply'),
            subject: 'Grazie per averci contattato',
        );
    }
    
    /**
    * Get the message content definition.
    */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact-mail',
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
