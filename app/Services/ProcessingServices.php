<?php

namespace App\Services;

use App\Services\reporte\FileProcessingService;
use App\Services\reporte\ReportServices;
use Illuminate\Http\Request;
use App\Models\comercio;
use App\Models\dbssurtigas;
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
        $reportesResultado = reportes::create($reportesData);

        //dbs_surtigas Cambio de Estado
        $dbs_surtigas = dbssurtigas::where('contrato', $reportesResultado->contrato)->first();
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
        $updateUbicacion = $this->Service->UpdateUbicacion($ubicacion,$reporte);
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
}
