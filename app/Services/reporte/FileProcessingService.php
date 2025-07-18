<?php

namespace App\Services\reporte;

use App\Models\reportes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileProcessingService
{

public function processImages(Request $request)
{
    $reportesData = [];
    $numeroContrato = $request->input('contrato');

    $nombresDescriptivos = [
        1 => 'Fachada',
        2 => 'Medidor',
        3 => 'Odometro',
        4 => 'Regulador',
        5 => 'Detector Fuga',
        6 => 'Exceso de Capacidad',
    ];

    foreach (range(1, 6) as $i) {
        $nombreInputFoto = 'foto' . $i;

        if ($imagen = $request->file($nombreInputFoto)) {
            $nombreBase = $nombresDescriptivos[$i] ?? 'Foto_Generica_' . $i;
            $extension = $imagen->getClientOriginalExtension();
            $nombreFoto = $nombreBase . '.' . $extension;

            // Ruta dentro del bucket: ejemplo -> imagen/123456/Fachada.jpg
            $ruta = "alenaqv2/{$numeroContrato}/{$nombreFoto}";

            // Sube el archivo al bucket con visibilidad pública
            Storage::disk('s3')->put($ruta, file_get_contents($imagen), 'public');

            // Genera la URL pública
            $urlFoto = Storage::disk('s3')->url($ruta);

            // Guarda la URL en el array
            $reportesData[$nombreInputFoto] = $urlFoto;
        }
    }

    return $reportesData;
}
public function processImagesUpdate(Request $request, $reporte)
{
    $reportesData = [];

    // Obtener número de contrato
    $numeroContrato = $request->input('contrato') ?? $reporte->dbSurtigas->contrato;

    // Nombres descriptivos
    $nombresDescriptivos = [
        1 => 'Fachada',
        2 => 'Medidor',
        3 => 'Odometro',
        4 => 'Regulador',
        5 => 'Detector_Fuga',
        6 => 'Exceso de Capacidad',
    ];

    // Rutas existentes (ya guardadas en BD)
    $imagenesExistentes = json_decode($reporte->imagenes, true) ?? [];

    foreach (range(1, 6) as $i) {
        $nombreInputFoto = 'foto' . $i;

        // Conservar imagen existente si no hay nueva
        if (isset($imagenesExistentes[$nombreInputFoto])) {
            $reportesData[$nombreInputFoto] = $imagenesExistentes[$nombreInputFoto];
        } else {
            unset($reportesData[$nombreInputFoto]);
        }

        // Si viene nueva imagen
        if ($imagen = $request->file($nombreInputFoto)) {
            $nombreBase = $nombresDescriptivos[$i] ?? 'Foto_Generica_' . $i;
            $extension = $imagen->getClientOriginalExtension();
            $nombreFotoFinal = $nombreBase . '.' . $extension;

            // Ruta dentro del bucket
            $ruta = "imagen/{$numeroContrato}/{$nombreFotoFinal}";

            // Sube al bucket y reemplaza si ya existe
            Storage::disk('spaces')->put($ruta, file_get_contents($imagen), 'public');

            // Genera URL pública
            $urlFoto = Storage::disk('spaces')->url($ruta);

            // Actualiza en el array final
            $reportesData[$nombreInputFoto] = $urlFoto;
        }
    }

    // Retornar como array o json_encode según lo que se espere
    return $reportesData;
}

}
