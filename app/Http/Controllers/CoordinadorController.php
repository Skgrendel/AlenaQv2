<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Services\ProcessingServices;
use App\Services\reporte\CreateReportServices;
use App\Services\coordinador\DataGisServices;
use App\Services\coordinador\ReportServices;
use App\Services\coordinador\ShowReportServices;
use Illuminate\Http\Request;



class CoordinadorController extends Controller
{
    private $Processing;
    private  $create;
    private  $info;
    private $show;
    private $report;

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
        $fontSize = 50;
        $reportes = reportes::find($request["id"]);
        $report = $request->all();

        if ($video = $request->file('video')) {
            $path = 'video/';
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $reportes['video'] = $videoname;
        }

        foreach (range(1, 6) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imagen/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $foto);
                $reportes['foto' . $i] = $foto;
                //  Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
                // Añadir texto del contrato  a la imagen
                $textoContrato = "Contrato N°:" . $reportes->contrato;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = 60; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);

                //Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = 120; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);
            }
        }
        $reportes->save($report);

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
        return view('coordinador.show', compact('data','gis'));
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
        ]);


        $estado = $request->estado;

        $reporte = reportes::find($id);

        if ($reporte == null) {
            return redirect()->route('coordinador.index')->with('error', 'No se encontró el reporte');
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

        if ($reporte == null) {

            return redirect()->route('coordinador.index')->with('error', 'No se encontró el reporte');
        }

        $reporte->delete();
        return redirect()->route('coordinador.index')->with('success', 'Reporte eliminado con éxito');
    }
}
