<?php

namespace App\Services\reporte;

use App\Mail\Notification_anomalia;
use App\Mail\Notification_fuga;
use App\Models\surtigas;
use DB;
use Illuminate\Support\Facades\Mail;

class AlertasService
{
    public function getAlertasAnomalia($request)
    {
        $enviarCorreo = false;
        $surtigasId = $request->surtigas_id; // Obtener el ID desde la petición

        // Buscar el registro en la base de datos
        $data = surtigas::where('id', $surtigasId)->first();

        // Obtener las anomalías seleccionadas (vienen como array)
        $anomalias = $request->input('anomalia', []); // Ej: [1, 3, 5]

        // Filtrar solo las anomalías diferentes de 8
        $anomaliasFiltradas = array_filter($anomalias, function ($anomalia) {
            return $anomalia != 8; // Cambia "8" por el valor que representa "Sin anomalía"
        });
        // Si hay al menos una anomalía diferente de 8, enviar correo
        if (!empty($anomaliasFiltradas)) {
            $enviarCorreo = true;
            // Obtener los nombres de las anomalías desde la base de datos
            $anomaliasNombres = DB::table('vs_anomalias')
                ->whereIn('id', $anomaliasFiltradas)
                ->pluck('nombre', 'id')
                ->toArray();
        }

        $alertas = [
            'alerta' => 'brayhan.suarez@surtigas.co',
            'alerta2' => 'brayan.mogollon@surtigas.co',
            'alerta3' => 'william.castano@surtigas.co'
        ];

        if ($enviarCorreo) {
            Mail::to($alertas['alerta']) // destinatario principal
                ->cc([$alertas['alerta2'], $alertas['alerta3']]) // destinatarios en copia
                ->queue(new Notification_anomalia($data, $anomaliasNombres));
        }
    }

    public function getAlertaFuga($request)
    {
        $enviarCorreo = false;
        $surtigasId = $request->surtigas_id; // Obtener el ID desde la petición

        // Buscar el registro en la base de datos
        $data = surtigas::where('id', $surtigasId)->first();

        // Obtener las anomalías seleccionadas (vienen como array)
        $anomalias = $request->input('fuga_gas'); // Ej: [1, 3, 5]

        if (!empty($anomalias) && $anomalias == true) {
            $enviarCorreo = true;
        }
        $alertas = [
            'alerta' => 'brayhan.suarez@surtigas.co',
            'alerta2' => 'brayan.mogollon@surtigas.co',
            'alerta3' => 'william.castano@surtigas.co'
        ];
        if ($enviarCorreo) {
            Mail::to($alertas['alerta'])
                ->cc([$alertas['alerta2'], $alertas['alerta3']])
                ->queue(new Notification_fuga($data));
        }
    }
}
