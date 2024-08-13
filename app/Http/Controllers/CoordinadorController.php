<?php

namespace App\Http\Controllers;

use App\Models\auditoria;
use App\Models\comercio;
use App\Models\reportes;
use App\Models\surtigas;
use App\Models\ubicacion;
use App\Services\ProcessingServices;
use App\Services\reporte\CreateReportServices;
use App\Services\coordinador\DataGisServices;
use App\Services\coordinador\ReportServices;
use App\Services\coordinador\ShowReportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class CoordinadorController extends Controller
{
    private $Processing, $create, $info, $show, $report;

    public function __construct()
    {
        $this->report  = new ReportServices();
        $this->Processing = new ProcessingServices;
        $this->info = new DataGisServices();
        $this->show = new ShowReportServices();
        $this->create = new CreateReportServices();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('coordinador.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->Processing->UpdateFile($request);
        return response()->json(['success' => 'Evidencias creadas con éxito']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->show->ShowReport($id);
        $gis = $this->info->DataGis($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('coordinador.show', compact('data', 'gis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reportes = $this->report->DownloadReport($id);
        return response()->download($reportes['file'])->deleteFileAfterSend();
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required',
        ], [
            'estado.required' => 'Por favor, selecciona una opción.',
        ]);

        $estado = $request->estado;
        $reporte = reportes::find($id);
        $ServicesUpdate = $this->Processing;

        if ($reporte == null) {
            return redirect()->route('coordinador.index')->with('error', 'No se encontró el reporte');
        }

        if ($request->input('revisado') == 1) {
            $ServicesUpdate->CreateAuditoria($request, $id);
            $ServicesUpdate->UpdateReportrevisado($request, $id);
        }

        if ($estado == 6) {
            $reporte->estado = $request->estado;
            $reporte->update();
            return redirect()->route('coordinador.index')->with('success', 'Reporte cerrado con éxito');
        }

        if ($estado == 7) {
            $reporte->estado = $request->estado;
            $reporte->observaciones = $request->observaciones;
            $reporte->update();
            return redirect()->route('coordinador.index')->with('success', 'Reporte rechazado con éxito');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reporte = reportes::find($id);
        $surtigas = surtigas::where('id', $reporte->surtigas_id)->first();
        $comercio = comercio::where('id', $reporte->comercios_id)->first();
        $ubicacion = ubicacion::where('id', $reporte->ubicacions_id)->first();

        if ($reporte == null) {
            return redirect()->route('coordinador.index')->with('error', 'No se encontró el reporte');
        } else {

            //Actualizar estado
            $datosActualizar = [
                'estado' => '1',
            ];
            $surtigas->update($datosActualizar);

            // Eliminar archivos de imágenes si existen
            if (!is_null($reporte->imagenes)) {
                $imagenes = json_decode($reporte->imagenes, true);
                foreach ($imagenes as $imagen) {
                    if (File::exists(public_path('imagen/' . $imagen))) {
                        File::delete(public_path('imagen/' . $imagen));
                    }
                }
            }

            // Eliminar archivos de video si existen
            if (!is_null($reporte->video)) {
                if (File::exists(public_path('video/' . $reporte->video))) {
                    File::delete(public_path('video/' . $reporte->video));
                }
            }


            $comercio->delete();
            $ubicacion->delete();
            $reporte->delete();

            return redirect()->route('coordinador.index')->with('success', 'Reporte eliminado con éxito');
        }
    }

    public function exportdoc($id)
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

        $outputFile = public_path('reportesmasivo/Reporte del contrato' . $reporte->dbSurtigas->contrato . '-' . $fecha . '-' . $rand . '.docx');
        $templateProcessor->saveAs($outputFile);

    }
}
