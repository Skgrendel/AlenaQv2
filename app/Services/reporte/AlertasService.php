<?php

namespace App\Services\reporte;

use App\Mail\Notification_anomalia;
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

        if ($enviarCorreo) {
            Mail::to(auth()->user()->email)->queue(new Notification_anomalia($data, $anomaliasNombres));
        }
    }
}
