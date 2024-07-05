<?php

namespace App\Services\coordinador;

use App\Models\surtigas;
use App\Models\reportes;
use App\Models\vs_anomalias;
use Carbon\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class ReportServices
{

    public function DownloadReport(string $id)
    {
        $reporte = reportes::find($id);

        $imagenes = json_decode($reporte->imagenes, true); // Decodificar como un array asociativo

        $anomaliasIds = json_decode($reporte->anomalia);

        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();

        $direccion = surtigas::where('contrato', $reporte->dbSurtigas->contrato)->first();


        // Ruta de la plantilla
        $templateFile = public_path('template/temp.docx');

        // Cargar la plantilla
        $templateProcessor = new TemplateProcessor($templateFile);

        // Reemplazar marcadores de posición con datos
        $templateProcessor->setValue('contrato', $reporte->dbSurtigas->contrato);
        $templateProcessor->setValue('fecha', $reporte->created_at);
        $templateProcessor->setValue('direccion', $direccion->direccion);
        $templateProcessor->setValue('medidor', $reporte->dbSurtigas->medidor);
        $templateProcessor->setValue('medidor_anomalia', $reporte->report_comercio->medidor_anomalia);
        $templateProcessor->setValue('lectura', $reporte->lectura);
        $templateProcessor->setValue('comercio', $reporte->report_comercio->vs_comercio->nombre);
        $nombresAnomalias = array();
        foreach ($anomalias as $anomalia) {
            $nombresAnomalias[] = $anomalia->nombre;
        }
        $stringAnomalias = implode(", ", $nombresAnomalias);
        $templateProcessor->setValue('anomalia', $stringAnomalias);

        $templateProcessor->setValue('imposibilidad', $reporte->vs_imposibilidad->nombre);
        $templateProcessor->setValue('observaciones', $reporte->comentarios);

        if (!empty($reporte->video) && file_exists(public_path('video/' . $reporte->video))) {
            $templateProcessor->setValue('video', config('app.url') . '/video/' . $reporte->video);
        } else {
            $templateProcessor->setValue('video', 'Sin Registro');
        }


        for ($i = 1; $i <= 5; $i++) {
            $foto = 'foto' . $i; // Para generar 'foto1', 'foto2', etc.
            if (isset($imagenes[$foto])) { // Verificar si la imagen existe en el array
                $this->ImgExist($imagenes[$foto], $templateProcessor, $foto);
            } else { // Si no existe en el array, establecer "Sin Registro Fotografico"
                $this->ImgExist(null, $templateProcessor, $foto);
            }
        }

        $rand = rand(600, 1000);
        $fecha = Carbon::now()->format('d-m-Y');

        $outputFile = public_path('template/Reporte del contrato ' . $reporte->dbSurtigas->contrato . '-' . $fecha . '-' . $rand . '.docx');
        $templateProcessor->saveAs($outputFile);

        // Descargar el documento
        return [
            'file' => $outputFile
        ];
    }

    private function ImgExist($img, $templateProcessor, $var)
    {
        if (file_exists(public_path('imagen/' . $img)) and $img != null) {
            return $templateProcessor->setImageValue($var, array('path' => public_path('imagen/' . $img), 'width' => 400, 'height' => 400, 'ratio' => true));
        } else {
            return $templateProcessor->setValue($var, 'Sin Registro Fotografico');
        }
    }
}
