<?php

namespace App\Http\Controllers;

use App\Models\encabezados_dets;
use App\Models\reportes;
use App\Models\vs_anomalias;
use App\Models\vs_estado;
use App\Models\vs_comercios;
use App\Models\vs_imposibilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:agente');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportes = reportes::with('personal', 'EstadoReporte')
            ->where('personal_id', Auth::user()->personal->id)
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
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        return view('agentes.create', compact('anomalias', 'comercios', 'imposibilidad'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(reportes::$rules);

        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $fontSize = 50;

        if ($request->input('contrato')) {
            $contrato = reportes::where('contrato', $request->input('contrato'))->first();
            if ($contrato) {
                return redirect()->route('reportes.create')->with('error', 'el Contrato ya fue registrado');
            }
        }

        if ($latitud == null || $longitud == null) {
            return redirect()->route('reportes.create')->with('error', 'No se pudo obtener la direccion , Active su GPS y vuelva a intentarlo');
        } else {
            $response = Http::withoutVerifying()->get("https://revgeocode.search.hereapi.com/v1/revgeocode?apikey=auuOOORgqWd_T4DFf0onY2JlvMDhz4tP0G0o7fRYDRU&at=$latitud,$longitud&lang=es-ES");
            $data = $response->json();
            $direccion = $data['items'][0]['address']['label'];
        }

        $AnomaliaJson = json_encode($request->anomalia);

        $reportes = $request->all();

        $reportes['personal_id'] = Auth::user()->personal->id;
        $reportes['anomalia'] = $AnomaliaJson;
        $reportes['latitud'] = $latitud;
        $reportes['longitud'] = $longitud;
        $reportes['direccion'] = $direccion;

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
                $textoContrato = "Contrato N°:" . $request->input('contrato');
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion: " . $direccion;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXCoordenadas = 10; // Ajusta según tu diseño
                $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);

                //Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");

                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));

                // Liberar la memoria
                imagedestroy($imagenGD);
            }
        }
        reportes::create($reportes);
        return redirect()->route('reportes.index')->with('success', 'Reporte Creado Con Exito');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reporte = reportes::find($id);
        $anomaliasIds = json_decode($reporte->anomalia);
        $anomalias = vs_anomalias::whereIn('id', $anomaliasIds)->get();
        return view('agentes.show', compact('reporte', 'anomalias'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $anomalias = vs_anomalias::pluck('nombre', 'id');
        $comercios = vs_comercios::pluck('nombre', 'id');
        $imposibilidad = vs_imposibilidad::pluck('nombre', 'id');
        $reporte = reportes::find($id);
        $anomaliasIds = json_decode($reporte->anomalia);
        return view('agentes.edit', compact('reporte', 'anomalias', 'comercios', 'imposibilidad', 'anomaliasIds'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $reporte)
    {
        $request->validate(reportes::$rulesupdate);
        $reportes = reportes::find($reporte);
        $report = $request->all();
        $AnomaliaJson = json_encode($request->anomalia);
        $reportes['anomalia'] = $AnomaliaJson;
        $estado = '5';
        $fontSize = 50;
        $reportes['estado'] =  $estado;


        if ($video = $request->file('video')) {
            $path = 'video/';
            // Obtener el nombre del video anterior desde la base de datos
            $videoAnterior = $reportes->video;
            // Eliminar el video anterior si existe
            if ($videoAnterior) {
                $rutaVideoAnterior = public_path($path . $videoAnterior);
                if (file_exists($rutaVideoAnterior)) {
                    unlink($rutaVideoAnterior);
                }
            }
            // Procesar y guardar el nuevo video
            $videoname = rand(1000, 9999) . "_" . date('YmdHis') . "." . $video->getClientOriginalExtension();
            $video->move($path, $videoname);
            $report['video'] = $videoname;
        } else {
            unset($report['video']);
        }

        foreach (range(1, 6) as $i) {
            if ($imagen = $request->file('foto' . $i)) {
                $path = 'imagen/';
                $foto = rand(1000, 9999) . "_" . date('YmdHis') . "." . $imagen->getClientOriginalExtension();
                $imagen->move($path, $foto);
                $report['foto' . $i] = $foto;
                //  Abrir la imagen utilizando GD
                $imagenGD = imagecreatefromjpeg(public_path($path . $foto));
                // Añadir texto del contrato  a la imagen
                $textoContrato = "Contrato N°:" . $reportes->contrato;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXContrato = 10; // Ajusta según tu diseño
                $posYContrato = imagesy($imagenGD) - 170; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXContrato, $posYContrato, $colorTexto, public_path('font/arial.ttf'), $textoContrato);
                // Añadir texto de coordenadas a la imagen
                $textoCoordenadas = "Direccion:" . $reportes->direccion;
                $colorTexto = imagecolorallocate($imagenGD, 255, 255, 255); // Color blanco
                $posXCoordenadas = 10; // Ajusta según tu diseño
                $posYCoordenadas = imagesy($imagenGD) - 20; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXCoordenadas, $posYCoordenadas, $colorTexto, public_path('font/arial.ttf'), $textoCoordenadas);
                //Añadir texto de fecha a la imagen
                $fechaActual = date("Y-m-d H:i:s");
                $posXFecha = 10; // Ajusta según tu diseño
                $posYFecha = imagesy($imagenGD) - 90; // Ajusta según tu diseño
                imagettftext($imagenGD, $fontSize, 0, $posXFecha, $posYFecha, $colorTexto, public_path('font/arial.ttf'), "Fecha: $fechaActual");
                // Guardar la imagen modificada
                imagejpeg($imagenGD, public_path($path . $foto));
                // Liberar la memoria
                imagedestroy($imagenGD);
                // Obtener el nombre de la foto anterior desde la base de datos
                $fotoAnterior = $reportes->foto . $i;
                // Eliminar la foto anterior si existe
                if ($fotoAnterior) {
                    $rutaFotoAnterior = public_path($path . $fotoAnterior);
                    if (file_exists($rutaFotoAnterior)) {
                        unlink($rutaFotoAnterior);
                    }
                }
                $report['foto' . $i] = $foto;
            } else {
                unset($report['foto' . $i]);
            }
        }


        $reportes->update($report);
        return redirect()->route('reportes.index')->with('success', 'Reporte Actualizado Con Exito');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportes $reportes)
    {
        //
    }


}
