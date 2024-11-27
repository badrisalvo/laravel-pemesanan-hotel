<?php

namespace App\Mail;

use App\Models\Booking;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Generate PDF dari view
        $pdf = PDF::loadView('pdf.booking', ['booking' => $this->booking]);

        return $this->subject('Booking Anda Telah Dikonfirmasi')
                    ->markdown('emails.booking.confirmed')
                    ->attachData($pdf->output(), 'booking-confirmation.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
