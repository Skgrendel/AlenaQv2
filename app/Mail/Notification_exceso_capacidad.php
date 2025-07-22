<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification_exceso_capacidad extends Mailable
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
        return $this->subject('Alerta: Exceso de Capacidad Detectado')
            ->view('emails.notificacion_exceso_capacidad')
            ->with(['data' => $this->data,]);
    }
}
