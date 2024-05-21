<?php

namespace App\Services;

use Illuminate\Http\Request;

class ImageProcessingService
{
    public function processImages(Request $request, $direccion, $fontSize = 50)
    {
        $reportes = [];

        foreach (range(1, 6) as $i) {
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

                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion: " . $direccion;
                $posXCoordenadas = 10; // Ajusta según tu diseño
                $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

                // Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);
            }
        }

        return $reportes;
    }
}
