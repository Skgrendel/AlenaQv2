<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification_Alertas_cau extends Mailable
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
            'cau' => $db['cau'] ?? 'sin datos',
        ];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Alerta: Notificación de Alertas CAU')
            ->view('emails.notificacion_alertas_cau')
            ->with(['data' => $this->data,]);
    }
}
