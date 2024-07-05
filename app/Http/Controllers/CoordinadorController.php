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
    private $Processing,$create,$info,$show,$report;
    
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
