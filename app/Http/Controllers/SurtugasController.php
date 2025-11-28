<?php

namespace App\Http\Controllers;

use App\Models\surtigas;
use App\Models\personals;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SurtugasPendientesExport;

class SurtugasController extends Controller
{
    /**
     * Mostrar surtigas pendientes por asignar
     */
    public function pendientes()
    {
        return view('surtigas.pendientes.index');
    }

    /**
     * Mostrar formulario para asignar un personal a un surtiga
     */
    public function asignar($id)
    {
        $surtiga = surtigas::findOrFail($id);

        // Validar que sea pendiente
        if ($surtiga->estado != 1 || $surtiga->personals_id != 0) {
            return redirect()->route('surtigas.pendientes')
                ->with('error', 'Este surtiga ya ha sido asignado.')
                ->with('icon', 'warning');
        }

        $personals = personals::where('estado', '3')->pluck('nombres', 'id');

        return view('surtigas.pendientes.asignar', compact('surtiga', 'personals'));
    }

    /**
     * Guardar la asignación de un personal a un surtiga
     */
    public function guardarAsignacion(Request $request, $id)
    {
        $request->validate([
            'personals_id' => 'required|exists:personals,id',
        ]);

        $surtiga = surtigas::findOrFail($id);

        $surtiga->update([
            'personals_id' => $request->personals_id,
        ]);

        return redirect()->route('surtigas.pendientes')
            ->with('success', 'Personal asignado exitosamente al contrato: ' . $surtiga->contrato)
            ->with('icon', 'success')
            ->with('title', 'Asignación Realizada');
    }

    /**
     * Mostrar formulario para asignación masiva por ciclo
     */
    public function asignarMasivo()
    {
        $ciclos = surtigas::where('estado', 1)
            ->where('personals_id', 0)
            ->distinct()
            ->pluck('ciclo')
            ->sort()
            ->all();

        $personals = personals::where('estado', '3')->pluck('nombres', 'id');

        return view('surtigas.pendientes.asignar-masivo', compact('ciclos', 'personals'));
    }

    /**
     * Guardar asignación masiva de un personal a múltiples surtigas por ciclo
     */
    public function guardarAsignacionMasiva(Request $request)
    {
        $request->validate([
            'personals_id' => 'required|exists:personals,id',
            'ciclo' => 'required|string',
        ]);

        $actualizado = surtigas::where('estado', 1)
            ->where('ciclo', $request->ciclo)
            ->where('personals_id', 0)
            ->update(['personals_id' => $request->personals_id]);

        if ($actualizado > 0) {
            return redirect()->route('surtigas.pendientes')
                ->with('success', "Se asignó el personal a {$actualizado} surtigas del ciclo {$request->ciclo}")
                ->with('icon', 'success')
                ->with('title', 'Asignación Masiva Realizada');
        }

        return redirect()->route('surtigas.pendientes')
            ->with('error', 'No hay surtigas pendientes para asignar en ese ciclo.')
            ->with('icon', 'warning');
    }

    /**
     * Mostrar cantidad de pendientes por ciclo
     */
    /**
     * Exportar surtigas pendientes a Excel
     */
    public function exportarPendientes()
    {
        $fecha = now()->format('Y-m-d_H-i-s');
        $filename = "Surtigas_Pendientes_{$fecha}.xlsx";

        return Excel::download(new SurtugasPendientesExport(), $filename);
    }
}
