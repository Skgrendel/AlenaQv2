<?php

namespace App\Http\Controllers;


use App\Models\reportes;
use App\Services\coordinador\DataGisServices;
use App\Services\coordinador\ReportServices;
use App\Services\coordinador\ShowReportServices;
use App\Services\ProcessingServices;
use App\Services\reporte\EditReportServices;
use Illuminate\Http\Request;


class AuditoriaController extends Controller
{
    private $report;
    private  $info;
    private $edit;
    private $Processing;
    private $show;
    public function __construct()
    {
        $this->Processing = new ProcessingServices;
        $this->edit = new EditReportServices();
        $this->info = new DataGisServices();
        $this->show = new ShowReportServices();
        $this->report  = new ReportServices();
    }
    public function index()
    {
        return view('auditoria.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auditoria.revisado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->edit->EditReport($id);
        $gis = $this->info->DataGis($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('auditoria.show', compact('data', 'gis'));
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
    public function update(Request $request, $reporte)
    {

       // dd($request->all());
        $ServicesUpdate = $this->Processing;
        $ServicesUpdate->UpdateReportAuditoria($request, $reporte);
        $ServicesUpdate->CreateAuditoria($request, $reporte);

        return redirect()->route('auditorias.index')->with('success', 'Reporte Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
