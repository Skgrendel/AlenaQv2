<?php

namespace App\Services\reporte;

use App\Models\reportes;
use Illuminate\Http\Request;

class FileProcessingService
{

public function processImages(Request $request)
{
    $reportesData = [];

    // Obtener el número de contrato del request
    $numeroContrato = $request->input('contrato');

    // Mapeo de índices de input a nombres de fotos descriptivos
    $nombresDescriptivos = [
        1 => 'Fachada',
        2 => 'Medidor',
        3 => 'Odometro',
        4 => 'Regulador',
        5 => 'Detector Fuga',
        6 => 'Exceso de Capacidad', // Ajusta este nombre si tienes otro tipo de foto para el 6
    ];

    foreach (range(1, 6) as $i) {
        $nombreInputFoto = 'foto' . $i;

        if ($imagen = $request->file($nombreInputFoto)) {
            // Define la ruta base para las imágenes, añadiendo el número de contrato
            // Esto creará una carpeta como 'imagen/NUMERO_CONTRATO/'
            $rutaBase = 'imagen/' . $numeroContrato . '/';

            // Crea la carpeta si no existe
            // Se ejecutará solo la primera vez para un nuevo contrato
            if (!file_exists(public_path($rutaBase))) {
                mkdir(public_path($rutaBase), 0777, true);
            }

            // Obtiene el nombre descriptivo del array de mapeo
            // Si por alguna razón $i no está en el array, usa un nombre genérico
            $nombreBase = $nombresDescriptivos[$i] ?? 'Foto_Generica_' . $i;

            // Construye el nombre final del archivo: NombreDescriptivo.Extension
            // Esto sobrescribirá cualquier archivo con el mismo nombre en la carpeta
            $nombreFoto = $nombreBase . "." . $imagen->getClientOriginalExtension();

            // Mueve la imagen a la subcarpeta.
            // Si ya existe una foto con ese nombre (ej. Fachada.jpg), la reemplazará.
            $imagen->move(public_path($rutaBase), $nombreFoto);

            // La ruta completa de la foto para guardar en la base de datos
            $rutaCompletaFoto = $rutaBase . $nombreFoto;

            // Almacena la ruta completa en el array de retorno
            $reportesData[$nombreInputFoto] = $rutaCompletaFoto;
        }
    }

    // Asegúrate de que el retorno sea un array si lo vas a usar directamente,
    // o json_encode si tu base de datos lo espera como JSON.
    return $reportesData; // O simplemente 'return $reportesData;' si lo quieres como array PHP
}

    // public function processVideo(Request $request)
    // {
    //     $reportesData = null;

    //     if ($video = $request->file('video')) {
    //         $path = 'video/';
    //         $videoname = $request->input('contrato') . "_" . rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
    //         $video->move($path, $videoname);
    //         $reportesData = $videoname;
    //     }

    //     return $reportesData;
    // }

    // public function processVideoUpdate(Request $request, $reporte)
    // {

    //     $reportesData = null;

    //     if ($video = $request->file('video')) {
    //         $path = 'video/';
    //         // Obtener el nombre del video anterior desde la base de datos
    //         $videoAnterior = $reporte->video;
    //         // Eliminar el video anterior si existe
    //         if ($videoAnterior) {
    //             $rutaVideoAnterior = public_path($path . $videoAnterior);
    //             if (file_exists($rutaVideoAnterior)) {
    //                 unlink($rutaVideoAnterior);
    //             }
    //         }
    //         // Procesar y guardar el nuevo video
    //         $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
    //         $video->move($path, $videoname);
    //         $reportesData = $videoname;
    //     }

    //     return $reportesData;
    // }

  public function processImagesUpdate(Request $request, $reporte)
{
    $reportesData = [];

    // Obtener el número de contrato del reporte existente o del request
    // Es crucial que esta variable tenga el ID del contrato correcto para la carpeta.
    $numeroContrato = $request->input('contrato') ?? $reporte->dbSurtigas->contrato;

    // Mapeo de índices de input a nombres de fotos descriptivos
    // ¡ESTE ARRAY DEBE SER IDÉNTICO AL USADO EN LA FUNCIÓN DE CREACIÓN!
    $nombresDescriptivos = [
        1 => 'Fachada',
        2 => 'Medidor',
        3 => 'Odometro',
        4 => 'Regulador',
        5 => 'Detector_Fuga',
        6 => 'Exceso de Capacidad', // Asegúrate de que este nombre coincida con tu lógica
    ];

    // Decodificar las rutas de las imágenes existentes del reporte actual
    // Estas son las rutas que están actualmente guardadas en la base de datos para este reporte.
    $imagenesExistentes = json_decode($reporte->imagenes, true) ?? [];

    foreach (range(1, 6) as $i) {
        $nombreInputFoto = 'foto' . $i; // Ejemplo: 'foto1', 'foto2', etc.

        // Primero, asumimos que mantendremos la imagen existente
        // Esto es importante para las fotos que no se van a actualizar
        if (isset($imagenesExistentes[$nombreInputFoto])) {
            $reportesData[$nombreInputFoto] = $imagenesExistentes[$nombreInputFoto];
        } else {
            // Si no hay una imagen existente para este campo, aseguramos que no esté en el array
            unset($reportesData[$nombreInputFoto]);
        }

        // Si se envió una nueva imagen para este campo específico...
        if ($imagen = $request->file($nombreInputFoto)) {
            // Define la ruta completa de la carpeta para este contrato
            $rutaCarpetaContrato = 'imagen/' . $numeroContrato . '/';

            // Por si acaso, crea la carpeta si no existe (raro en update, pero buena práctica)
            if (!file_exists(public_path($rutaCarpetaContrato))) {
                mkdir(public_path($rutaCarpetaContrato), 0777, true);
            }

            // Obtiene el nombre descriptivo para el archivo de la imagen actual
            $nombreBase = $nombresDescriptivos[$i] ?? 'Foto_Generica_' . $i;

            // Construye el nombre final del archivo: NombreDescriptivo.Extension
            $nombreFotoFinal = $nombreBase . "." . $imagen->getClientOriginalExtension();

            // Mueve la nueva imagen a la carpeta.
            // Si ya existe una imagen con el mismo $nombreFotoFinal en esa carpeta, ¡LA SOBRESCRIBIRÁ!
            $imagen->move(public_path($rutaCarpetaContrato), $nombreFotoFinal);

            // Actualiza la ruta en el array $reportesData con la nueva ruta de la foto
            $reportesData[$nombreInputFoto] = $rutaCarpetaContrato . $nombreFotoFinal;
        }
        // Si no se envió una nueva imagen, el valor ya se estableció arriba (manteniendo la existente o unset).
    }

    // Retorna el array con las rutas actualizadas (o mantenidas) de las fotos.
    // Si tu base de datos espera un JSON, usa json_encode($reportesData);
    return $reportesData;
}
}
