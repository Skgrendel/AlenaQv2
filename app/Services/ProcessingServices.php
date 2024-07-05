<?php

namespace App\Services;

use App\Models\auditoria;
use App\Services\reporte\FileProcessingService;
use App\Services\reporte\ReportServices;
use Illuminate\Http\Request;
use App\Models\comercio;
use App\Models\surtigas;
use App\Models\reportes;
use App\Models\ubicacion;

class ProcessingServices
{
    private $file;
    private $Service;


    public function __construct()
    {
        // Inicializar propiedades
        $this->file = new FileProcessingService();
        $this->Service = new ReportServices();
    }

    public function StoreReport(Request $request, $id)
    {
        //Procesar Archivos Multimedia
        $fotos = $this->file->processImages($request);
        $video = $this->file->processVideo($request);


        //Procesar Ubicacion y Comercio
        $ubicacionData = $this->Service->StoreUbicacion($request);
        $comercioData = $this->Service->StoreComercio($request);

        //Guardar Ubicacion y Comercio
        $ubicacion = ubicacion::create($ubicacionData);
        $comercio = comercio::create($comercioData);

        //Procesar Reporte
        $reportesData = $this->Service->StoreReportes($request, $fotos, $id, $ubicacion->id, $comercio->id, $video);

        //Guardar Reporte
        $Resultado = reportes::create($reportesData);

        //dbs_surtigas Cambio de Estado
        $dbs_surtigas = surtigas::where('id', $Resultado->surtigas_id)->first();
        $dbs_surtigas->estado = '0';
        $dbs_surtigas->update();
    }

    public function UpdateReport(Request $request, $reportes)
    {
        $reporte = reportes::find($reportes);
        $fotos = $this->file->processImagesUpdate($request, $reporte);
        $video = $this->file->processVideoUpdate($request, $reporte);
        $ubicacion = $this->Service->StoreUbicacion($request);
        $updateComercio = $this->Service->UpdateComercio($request, $reporte);
        $updateUbicacion = $this->Service->UpdateUbicacion($ubicacion, $reporte);
        $AnomaliaJson = json_encode($request->anomalia);
        $datosActualizados = [
            'anomalia' => json_encode($request->anomalia),
            'estado' => '5',
            'video' => $video,
            'imagenes' => $fotos,
            'lectura' => $request->input('lectura'),
            'imposibilidad' => $request->input('imposibilidad'),
            'comentarios' => $request->input('comentarios'),
        ];
        $reporte->update($datosActualizados);
    }
    public function UpdateReportAuditoria(Request $request, $reportes)
    {
        $reporte = reportes::find($reportes);
        $updateComercio = $this->Service->UpdateComercio($request, $reporte);
        $AnomaliaJson = json_encode($request->input('anomalias'));
        $datosActualizados = [
            'anomalia' => $AnomaliaJson,
            'lectura' => $request->input('lectura'),
            'imposibilidad' => $request->input('imposibilidad'),
            'comentarios' => $request->input('comentarios'),
            'revisado' => $request->input('revisado')
        ];
        $reporte->update($datosActualizados);
    }

    public function CreateAuditoria(Request $request, $id)
    {
        $reportes = reportes::find($id);
        $validate = auditoria::where('reportes_id', $reportes->id)->first();
        if ($validate) {
            return [
                'error' => 'Ya se Registro una auditoria para este contrato'
            ];
        } else {
            auditoria::create([
                'reportes_id' => $reportes->id,
                'medidor_coincide' => $request->input('medidor_coincide'),
                'lectura_correcta' => $request->input('lectura_correcta'),
                'foto_correcta' => $request->input('foto_correcta'),
                'comercio_coincide' => $request->input('comercio_coincide'),
                'anomalias_coincide' => $request->input('anomalias_coincide'),
                'intento_soborno' => $request->input('soborno'),
                'observaciones' => $request->input('observaciones'),
            ]);
        }
    }
}
