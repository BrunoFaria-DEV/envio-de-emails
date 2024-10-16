<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MailtrapMail extends Mailable
{
    use Queueable, SerializesModels;

    public $shipping, $shippingEmail;

     /**
     * Create a new message instance.
     */
    public function __construct($shipping, $shippingEmail)
    {
        $this->shipping = $shipping;
        $this->shippingEmail = $shippingEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->shipping->title,
            from: new Address( $this->shipping->customerAccount->email ),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.mail_trap.mail_trap',
            with: [
                'shipping' => $this->shipping,
                'shipping_email' => $this->shippingEmail
            ],

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
