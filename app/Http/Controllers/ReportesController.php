<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\surtigas;
use App\Models\vs_estado;
use App\Services\coordinador\DataGisServices;
use App\Services\ProcessingServices;
use App\Services\reporte\CreateReportServices;
use App\Services\reporte\EditReportServices;
use App\Services\reporte\ShowReportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;


class ReportesController extends Controller
{

    private $Processing, $info, $create, $show, $gis;

    public function __construct()
    {
        $this->Processing = new ProcessingServices;
        $this->info = new EditReportServices();
        $this->create = new CreateReportServices();
        $this->show = new ShowReportServices();
        $this->gis  = new DataGisServices();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportes = reportes::with('personal', 'vs_estado')
            ->where('personals_id', Auth::user()->personal->id)
            ->whereIn('estado', [5, 7])
            ->get();
        $estados = vs_estado::all();

        return view('agentes.index', compact('reportes', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->personal->id;
        $ServicesStore = $this->Processing;
        $ServicesStore->StoreReport($request, $id);
        return redirect()->route('reportes.index')->with('success', 'Reporte Creado Con Exito');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = $this->create->CreateReport($id);
        $gis = $this->gis->DataGisubicacion($id);
        return view('agentes.create', compact('data', 'gis'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->info->EditReport($id);
        $gis = $this->gis->DataGis($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('agentes.edit', compact('data', 'gis'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reporte)
    {
        $ServicesUpdate = $this->Processing;
        $ServicesUpdate->UpdateReport($request, $reporte);
        $ServicesUpdate->UpdateFile($request);
        return redirect()->route('reportes.index')->with('success', 'Reporte Actualizado Con Exito');
    }

    public function showreporte(string $id)
    {
        $data = $this->show->ShowReport($id);
        $gis = $this->gis->DataGishow($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('agentes.show', compact('data', 'gis'));
    }

    public function descargarZipReportes()
    {
        $reportes = reportes::all(); // Puedes agregar un filtro si necesitas

        $tempFolder = storage_path('app/temp_reportes_' . uniqid());
        File::makeDirectory($tempFolder, 0755, true);

        foreach ($reportes as $reporte) {
            $imagenes = json_decode($reporte->imagenes, true);
            $anomalias = json_decode($reporte->anomalia, true);
            $direccion = surtigas::where('contrato', $reporte->dbSurtigas->contrato)->first();

            $fecha = Carbon::parse($reporte->created_at)->format('d-m-Y');
            $fechaGeneracion = Carbon::now()->format('d-m-Y');

            $templateProcessor = new TemplateProcessor(public_path('template/temp.docx'));

            // Set de valores del reporte
            $templateProcessor->setValue('contrato', $reporte->dbSurtigas->contrato ?? 'Sin Contrato');
            $templateProcessor->setValue('fecha', $fecha ?? 'Sin Fecha');
            $templateProcessor->setValue('fecha_generacion', $fechaGeneracion ?? 'Sin Fecha de Generacion');
            $templateProcessor->setValue('direccion', $direccion->direccion ?? 'Sin Direccion');
            $templateProcessor->setValue('medidor', $reporte->dbSurtigas->medidor ?? 'Sin Medidor');
            $templateProcessor->setValue('medidor_anomalia', $reporte->report_comercio->medidor_anomalia ?? 'Sin Medidor Anomalia');
            $templateProcessor->setValue('lectura', $reporte->lectura ?? 'Sin Lectura');
            $templateProcessor->setValue('comercio', $reporte->report_comercio->tipo_comercio ?? 'Sin Comercio');
            $templateProcessor->setValue('nombre_comercio', $reporte->report_comercio->nombre_comercio ?? 'Sin Nombre de Comercio');
            $templateProcessor->setValue('anomalia', is_array($anomalias) ? implode(", ", $anomalias) : 'Sin Anomalias');
            $templateProcessor->setValue('tipo_presion', $reporte->tipo_presion ?? 'Sin Tipo de Presion');
            $templateProcessor->setValue('descripcion_medidor', $reporte->descripcion_medidor ?? 'Sin Descripcion de Medidor');
            $templateProcessor->setValue('marca_medidor', $reporte->marca_medidor ?? 'Sin Marca Medidor');
            $templateProcessor->setValue('marca_regulador', $reporte->marca_regulador ?? 'Sin Marca Regulador');
            $templateProcessor->setValue('cau', $reporte->cau ?? 'Sin Marca Alertas');
            $templateProcessor->setValue('imposibilidad', $reporte->imposibilidad ?? 'Sin Imposibilidad');
            $templateProcessor->setValue('observaciones', $reporte->comentarios ?? 'Sin Observaciones');

            // Imágenes desde URL (DigitalOcean Spaces)
            for ($i = 1; $i <= 6; $i++) {
                $foto = 'foto' . $i;
                $this->ImgExist($imagenes[$foto] ?? null, $templateProcessor, $foto);
            }

            $filename = 'Reporte_' . $reporte->dbSurtigas->contrato . '.docx';
            $templateProcessor->saveAs($tempFolder . '/' . $filename);
        }

        // Crear el archivo ZIP
        $zipPath = storage_path('app/reportes_' . now()->format('Ymd_His') . '.zip');
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            foreach (File::files($tempFolder) as $file) {
                $zip->addFile($file, $file->getFilename());
            }
            $zip->close();
        }

        // Eliminar la carpeta temporal de los Word
        File::deleteDirectory($tempFolder);

        // Devolver ZIP y eliminar tras la descarga
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
    private function ImgExist($imgUrl, $templateProcessor, $var)
    {
        if ($imgUrl != null) {
            try {
                $imageContents = file_get_contents($imgUrl);
                if ($imageContents !== false) {
                    $tempPath = storage_path('app/' . uniqid('img_') . '.jpg');
                    file_put_contents($tempPath, $imageContents);
                    $templateProcessor->setImageValue($var, [
                        'path' => $tempPath,
                        'width' => 400,
                        'height' => 400,
                        'ratio' => true
                    ]);
                    unlink($tempPath);
                    return;
                }
            } catch (\Exception $e) {
                // Log::error("Error descargando imagen $imgUrl: " . $e->getMessage());
            }
        }
        $templateProcessor->setValue($var, 'Sin Registro Fotografico');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function Rechazar($id)
    {
        $reportes = reportes::find($id);
        $reportes->estado = 7;
        $reportes->update();
        return redirect()->route('entregados')->with('success', 'Reporte Rechazado');
    }

}
