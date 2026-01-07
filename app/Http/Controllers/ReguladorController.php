<?php

namespace App\Http\Controllers;

use App\Models\encabezados_dets;
use Illuminate\Http\Request;

class ReguladorController extends Controller
{
    const ENCABEZADO_ID = 8; // ID para reguladores

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reguladores = encabezados_dets::where('encabezados_id', self::ENCABEZADO_ID)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reguladores.index', compact('reguladores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reguladores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:encabezados_dets,nombre,NULL,id,encabezados_id,8',
            'nomenclatura' => 'required|string|max:255'
        ]);

        encabezados_dets::create([
            'nombre' => $request->nombre,
            'nomenclatura' => $request->nomenclatura,
            'encabezados_id' => self::ENCABEZADO_ID
        ]);

        return redirect()->route('reguladores.index')
            ->with('success', 'Regulador creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $regulador = encabezados_dets::findOrFail($id);

        // Verificar que sea un regulador (encabezados_id = 8)
        if ($regulador->encabezados_id != self::ENCABEZADO_ID) {
            abort(404);
        }
        return view('reguladores.edit', compact('regulador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $regulador = encabezados_dets::findOrFail($id);

        // Verificar que sea un regulador (encabezados_id = 8)
        if ($regulador->encabezados_id != self::ENCABEZADO_ID) {
            abort(404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255|unique:encabezados_dets,nombre,' . $regulador->id . ',id,encabezados_id,8',
            'nomenclatura' => 'required|string|max:255'
        ]);

        $regulador->update([
            'nombre' => $request->nombre,
            'nomenclatura' => $request->nomenclatura
        ]);

        return redirect()->route('reguladores.index')
            ->with('success', 'Regulador actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regulador = encabezados_dets::findOrFail($id);

        // Verificar que sea un regulador (encabezados_id = 8)
        if ($regulador->encabezados_id != self::ENCABEZADO_ID) {
            abort(404);
        }

        $regulador->delete();

        return redirect()->route('reguladores.index')
            ->with('success', 'Regulador eliminado exitosamente.');
    }
}
