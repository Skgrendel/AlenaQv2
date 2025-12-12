<?php

namespace App\Http\Controllers;

use App\Models\GisToken;
use Illuminate\Http\Request;

class GisTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tokens = GisToken::orderBy('created_at', 'desc')->get();
        return view('gis-tokens.index', compact('tokens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gis-tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'descripcion' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        // Si el nuevo token está activo, desactivar todos los demás
        if ($request->activo) {
            GisToken::where('activo', true)->update(['activo' => false]);
        }

        GisToken::create([
            'token' => $request->token,
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo') ? true : false
        ]);

        return redirect()->route('gis-tokens.index')
            ->with('success', 'Token GIS creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GisToken $gisToken)
    {
        return view('gis-tokens.edit', compact('gisToken'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GisToken $gisToken)
    {
        $request->validate([
            'token' => 'required|string',
            'descripcion' => 'nullable|string|max:255',
            'activo' => 'boolean'
        ]);

        // Si se activa este token, desactivar todos los demás
        if ($request->activo && !$gisToken->activo) {
            GisToken::where('activo', true)->update(['activo' => false]);
        }

        $gisToken->update([
            'token' => $request->token,
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo') ? true : false
        ]);

        return redirect()->route('gis-tokens.index')
            ->with('success', 'Token GIS actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GisToken $gisToken)
    {
        $gisToken->delete();

        return redirect()->route('gis-tokens.index')
            ->with('success', 'Token GIS eliminado exitosamente.');
    }

    /**
     * Activate a token
     */
    public function activate(GisToken $gisToken)
    {
        // Desactivar todos los tokens
        GisToken::where('activo', true)->update(['activo' => false]);

        // Activar el seleccionado
        $gisToken->update(['activo' => true]);

        return redirect()->route('gis-tokens.index')
            ->with('success', 'Token GIS activado exitosamente.');
    }
}
