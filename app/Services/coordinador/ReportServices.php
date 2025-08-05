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

        $anomalias = json_decode($reporte->anomalia);

        $direccion = surtigas::where('contrato', $reporte->dbSurtigas->contrato)->first();

        $fecha = Carbon::parse($reporte->created_at)->format('d-m-Y');
        $fechaGeneracion = Carbon::now()->format('d-m-Y');


        // Ruta de la plantilla
        $templateFile = public_path('template/temp.docx');

        // Cargar la plantilla
        $templateProcessor = new TemplateProcessor($templateFile);

        // Reemplazar marcadores de posición con datos
        $templateProcessor->setValue('contrato', $reporte->dbSurtigas->contrato ?? 'Sin Contrato');
        $templateProcessor->setValue('fecha', $fecha ?? 'Sin Fecha');
        $templateProcessor->setValue('fecha_generacion', $fechaGeneracion ?? 'Sin Fecha de Generacion');
        $templateProcessor->setValue('direccion', $direccion->direccion ?? 'Sin Direccion');
        $templateProcessor->setValue('medidor', $reporte->dbSurtigas->medidor ?? 'Sin Medidor');
        $templateProcessor->setValue('medidor_anomalia', $reporte->report_comercio->medidor_anomalia ?? 'Sin Medidor Anomalia');
        $templateProcessor->setValue('lectura', $reporte->lectura ?? 'Sin Lectura');
        $templateProcessor->setValue('comercio', $reporte->report_comercio->tipo_comercio ?? 'Sin Comercio');
        $templateProcessor->setValue('nombre_comercio', $reporte->report_comercio->nombre_comercio ?? 'Sin Nombre de Comercio');
        $stringAnomalias = implode(", ", $anomalias);
        $templateProcessor->setValue('anomalia', $stringAnomalias ?? 'Sin Anomalias');
        $templateProcessor->setValue('tipo_presion', $reporte->tipo_presion ?? 'Sin Tipo de Presion');
        $templateProcessor->setValue('descripción_medidor', $reporte->descripción_medidor ?? 'Sin Descripcion de Medidor');
        $templateProcessor->setValue('marca_medidor', $reporte->marca_medidor ?? 'Sin Marca Medidor');
        $templateProcessor->setValue('marca_regulador', $reporte->marca_regulador ?? 'Sin Marca Regulador');
        $templateProcessor->setValue('cau', $reporte->cau ?? 'Sin Marca Alertas');
        $templateProcessor->setValue('imposibilidad', $reporte->imposibilidad ?? 'Sin Imposibilidad');
        $templateProcessor->setValue('observaciones', $reporte->comentarios ?? 'Sin Observaciones');

        for ($i = 1; $i <= 6; $i++) {
            $foto = 'foto' . $i; // Para generar 'foto1', 'foto2', etc.
            $this->ImgExist($imagenes[$foto] ?? null, $templateProcessor, $foto);
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

   private function ImgExist($imgPath, $templateProcessor, $var)
{
    if ($imgPath != null && file_exists(public_path($imgPath))) {
        // La ruta ya incluye la carpeta y el nombre de la imagen
        return $templateProcessor->setImageValue($var, [
            'path' => public_path($imgPath),
            'width' => 400,
            'height' => 400,
            'ratio' => true
        ]);
    } else {
        return $templateProcessor->setValue($var, 'Sin Registro Fotografico');
    }
}

}
