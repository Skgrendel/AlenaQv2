<?php

namespace App\Services\coordinador;

use App\Models\surtigas;
use App\Models\reportes;
use App\Models\vs_anomalias;
use Illuminate\Support\Facades\Storage;
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
        $templateProcessor->setValue('descripcion_medidor', $reporte->descripción_medidor ?? 'Sin Descripcion de Medidor');
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

private function ImgExist($imgUrl, $templateProcessor, $var)
{
    if ($imgUrl != null) {
        try {
            // Obtener contenido de la imagen desde URL pública
            $imageContents = file_get_contents($imgUrl);

            if ($imageContents !== false) {
                // Guardar temporalmente en local
                $tempPath = storage_path('app/' . uniqid('img_') . '.jpg');
                file_put_contents($tempPath, $imageContents);

                // Insertar en el Word
                $templateProcessor->setImageValue($var, [
                    'path' => $tempPath,
                    'width' => 400,
                    'height' => 400,
                    'ratio' => true
                ]);

                // Eliminar archivo temporal
                unlink($tempPath);
                return;
            }
        } catch (\Exception $e) {
            // Puedes loguear el error si deseas
        }
    }

    // Si no hay URL o no se pudo descargar
    $templateProcessor->setValue($var, 'Sin Registro Fotografico');
}


}
