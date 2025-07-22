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

    public $data;


    /**
     * Create a new message instance.
     */
    public function __construct($reportes)
    {
        // Transformamos los datos del array en un objeto plano para la vista
        $db = $reportes['info']['db_Surtigas'] ?? [];

        $this->data = (object)[
            'cliente' => $db['cliente'] ?? 'sin datos',
            'contrato' => $db['contrato'] ?? 'sin datos',
            'medidor' => $db['medidor'] ?? 'sin datos',
            'direccion' => $db['direccion'] ?? 'sin datos',
            'ciclo' => $db['ciclo'] ?? 'sin datos',
            'barrio' => $db['barrio'] ?? 'sin datos',
            'estado_servicio' => $db['estado_servicio'] == 1 ? 'Activo' : 'Inactivo',
        ];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notificacion de Anomalia')
            ->view('emails.notificacion_fuga')
            ->with([
                'data' => $this->data,
            ]);
    }
}
