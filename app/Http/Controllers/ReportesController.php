<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\vs_estado;
use App\Services\coordinador\DataGisServices;
use App\Services\ProcessingServices;
use App\Services\reporte\CreateReportServices;
use App\Services\reporte\EditReportServices;
use App\Services\reporte\ShowReportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        dd($request->all());
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
        return redirect()->route('reportes.index')->with('success', 'Reporte Actualizado Con Exito');
    }

    public function showreporte(string $id)
    {
        $data = $this->show->ShowReport($id);
        $gis = $this->gis->DataGis($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('agentes.show', compact('data', 'gis'));
    }
}
