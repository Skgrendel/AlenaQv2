<?php

namespace App\Http\Controllers;

use App\Models\configuraciones;
use App\Models\surtigas;
use Illuminate\Http\Request;

class ConfiguracionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciclos = surtigas::pluck('ciclo', 'ciclo');
        $data = configuraciones::find('1');
        return view('configuracion.index', compact('data', 'ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = configuraciones::find($id);
        $data->update($request->all());
        return redirect()->route('configs.index')->with('success', 'Ciclo Asignado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
