<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification_anomalia extends Mailable
{
    use Queueable, SerializesModels;

    public $reportes;
    public $anomalias;


    /**
     * Create a new message instance.
     */
    public function __construct($reportes, $anomalias)
    {
        $this->reportes = $reportes;
        $this->anomalias = $anomalias;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notificacion de Anomalia')
                    ->view('emails.notificacion_anomalia')
                    ->with([
                        'data' => $this->reportes,
                        'anomalias' => $this->anomalias,
                    ]);
    }
}
