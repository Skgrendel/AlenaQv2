<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\vs_estado;
use App\Services\ProcessingServices;
use App\Services\reporte\CreateReportServices;
use App\Services\reporte\EditReportServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportesController extends Controller
{

    private $Processing;
    private  $info;

    public function __construct()
    {
        $this->middleware('can:agente');
        $this->Processing = new ProcessingServices;
        $this->info = new EditReportServices();
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->personal->id;
        $ServicesStore = $this->Processing;
        $ServicesStore->StoreReport($request,$id);

        return redirect()->route('reportes.index')->with('success', 'Reporte Creado Con Exito');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $create = new CreateReportServices();
        $data = $create->CreateReport($id);

        return view('agentes.create', compact('data'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->info->EditReport($id);
        $data['imagenes'] = (array) $data['imagenes'];
        return view('agentes.edit', compact('data'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reporte)
    {
        $ServicesUpdate = $this->Processing;
        $ServicesUpdate->UpdateReport($request,$reporte);

        return redirect()->route('reportes.index')->with('success', 'Reporte Actualizado Con Exito');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
