<?php

namespace App\Services\reporte;

use App\Models\reportes;
use Illuminate\Http\Request;

class FileProcessingService
{
    public function processImages(Request $request, $fontSize = 40)
    {
        $reportes = [];
        foreach (range(1, 5) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imagen/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move(public_path($path), $foto);
                $reportes['foto' . $i] = $foto;

                // Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));

                // Añadir texto del contrato a la imagen
                $textoContrato = "Contrato N°:" . $request->input('contrato');
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);

                // Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 100; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);
            }
        }

        return $reportes;
    }

    public function processVideo(Request $request)
    {
        $reportesData = null;

        if ($video = $request->file('video')) {
            $path = 'video/';
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $reportesData = $videoname;
        }

        return $reportesData;
    }

    public function processVideoUpdate(Request $request,$reporte){

        $reportesData = null;

        if ($video = $request->file('video')) {
            $path = 'video/';
            // Obtener el nombre del video anterior desde la base de datos
            $videoAnterior = $reporte->video;
            // Eliminar el video anterior si existe
            if ($videoAnterior) {
                $rutaVideoAnterior = public_path($path . $videoAnterior);
                if (file_exists($rutaVideoAnterior)) {
                    unlink($rutaVideoAnterior);
                }
            }
            // Procesar y guardar el nuevo video
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $reportesData = $videoname;
        }

        return $reportesData;
    }

    public function processImagesUpdate(Request $request,$reporte)
    {
        $reportesData = [];
        $fontSize = 40;
        $imagenes = json_decode($reporte->imagenes, true) ?? [];

        foreach (range(1, 5) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
              $path = 'imagen/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move(public_path($path), $foto);
                $reportes['foto' . $i] = $foto;

                // Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));

                // Añadir texto del contrato a la imagen
                $textoContrato = "Contrato N°:" . $reporte->dbSurtigas->contrato;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);

                // Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 100; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);

                // Obtener el nombre de la foto anterior desde la base de datos
                $fotoAnterior = $imagenes['foto' . $i] ?? null;

                // Eliminar la foto anterior si existe
                if ($fotoAnterior) {
                    $rutaFotoAnterior = public_path($path . $fotoAnterior);
                    if (file_exists($rutaFotoAnterior)) {
                        unlink($rutaFotoAnterior);
                    }
                }
                $reportesData['foto' . $i] = $foto;
            } else {
                 // Asegurarse de que la entrada de la foto no exista si no hay una nueva foto
                unset($reportesData['foto' . $i]);
            }
        }

        return $reportesData;
    }
}
