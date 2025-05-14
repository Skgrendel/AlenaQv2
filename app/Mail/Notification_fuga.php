<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification_fuga extends Mailable
{
    use Queueable, SerializesModels;


    public $reportes;


    /**
     * Create a new message instance.
     */
    public function __construct($reportes)
    {
        $this->reportes = $reportes;

    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notificacion de Anomalia')
                    ->view('emails.notificacion_fuga')
                    ->with([
                        'data' => $this->reportes,
                    ]);
    }
}
