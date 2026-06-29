<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class bookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $booking,$url;

    /**
     * Create a new message instance.
     */
    public function __construct($booking,$url)
    {
        $this->booking = $booking;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $servicename = $this->booking->getbooking->service_name;
        return $this->subject("Booking Confirmed - $servicename")
        ->view('emails.booking');
    }
}
