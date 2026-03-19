<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use App\Models\encabezados_dets;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function InfoGeneral()
    {
        // Total de lecturas realizadas
        $lecturasRealizadas = reportes::count();

        // Lecturas restantes (estimado)
        $lecturasRestantes = 0; // Ajustar según tu lógica

        // Porcentaje completado
        $porcentajeCompletado = 100.0; // Ajustar según ciclo actual

        // Total de anomalías detectadas
        $totalAnomalias = $this->countAnomalias();

        // Detalles de anomalías
        $anomaliasDetectadas = $this->getAnomaliesByType();

        // Número de lecturas por tipo de comercio
        $lecturasPorComercio = $this->getLecturasPorComercio();

        // Tipo de comercio con más anomalías
        $comercioMasAnomalias = $this->getComercioMasAnomalias();

        // Datos por ciclo
        $lecturasporCiclo = $this->getLecturasPorCiclo();

        // Estado de reportes
        $estadoReportes = $this->getEstadoReportes();

        return view('informes.informeGeneral', compact(
            'lecturasRealizadas',
            'lecturasRestantes',
            'porcentajeCompletado',
            'totalAnomalias',
            'anomaliasDetectadas',
            'lecturasPorComercio',
            'comercioMasAnomalias',
            'lecturasporCiclo',
            'estadoReportes'
        ));
    }

    /**
     * Contar el total de anomalías en todos los reportes (excluyendo 'Sin Anomalías')
     */
    private function countAnomalias()
    {
        $reportes = reportes::all();
        $count = 0;

        foreach ($reportes as $reporte) {
            if ($reporte->anomalia) {
                $anomalias = is_string($reporte->anomalia) ? json_decode($reporte->anomalia, true) : $reporte->anomalia;
                if (is_array($anomalias)) {
                    foreach ($anomalias as $anomalia) {
                        if (!$this->debeExcluirAnomalia($anomalia)) {
                            $count++;
                        }
                    }
                }
            }
        }

        return $count;
    }

    /**
     * Obtener conteo de anomalías por tipo (excluyendo 'Sin Anomalías')
     */
    private function getAnomaliesByType()
    {
        // Obtener mapa de IDs a nombres de anomalías
        $anomaliasMap = DB::table('encabezados_dets')
            ->where('encabezados_id', 3)
            ->pluck('nombre', 'id')
            ->toArray();

        $reportes = reportes::all();
        $anomaliasArray = [];

        foreach ($reportes as $reporte) {
            if ($reporte->anomalia) {
                $anomalias = is_string($reporte->anomalia) ? json_decode($reporte->anomalia, true) : $reporte->anomalia;
                if (is_array($anomalias)) {
                    foreach ($anomalias as $anomaliaId) {
                        // Mapear ID a nombre si existe
                        $anomaliaNombre = $anomaliasMap[$anomaliaId] ?? $anomaliaId;

                        // Excluir anomalías que deben ser ignoradas
                        if ($this->debeExcluirAnomalia($anomaliaNombre)) {
                            continue;
                        }

                        if (isset($anomaliasArray[$anomaliaNombre])) {
                            $anomaliasArray[$anomaliaNombre]++;
                        } else {
                            $anomaliasArray[$anomaliaNombre] = 1;
                        }
                    }
                }
            }
        }

        // Ordenar descendente
        arsort($anomaliasArray);
        return array_slice($anomaliasArray, 0, 10); // Top 10
    }

    /**
     * Obtener lecturas agrupadas por tipo de comercio
     */
    private function getLecturasPorComercio()
    {
        return DB::table('reportes')
            ->join('comercios', 'reportes.comercios_id', '=', 'comercios.id')
            ->select('comercios.tipo_comercio as nombre', DB::raw('count(*) as total'))
            ->groupBy('comercios.tipo_comercio')
            ->orderByDesc('total')
            ->get()
            ->toArray();
    }

    /**
     * Obtener tipo de comercio con más anomalías (excluyendo 'Sin Anomalías')
     */
    private function getComercioMasAnomalias()
    {
        $reportes = reportes::with('report_comercio')->get();
        $comerciosAnomalias = [];

        foreach ($reportes as $reporte) {
            $comercio = $reporte->report_comercio ? $reporte->report_comercio->tipo_comercio : 'Desconocido';

            if ($reporte->anomalia) {
                $anomalias = is_string($reporte->anomalia) ? json_decode($reporte->anomalia, true) : $reporte->anomalia;
                if (is_array($anomalias)) {
                    $count = 0;
                    foreach ($anomalias as $a) {
                        if (!$this->debeExcluirAnomalia($a)) {
                            $count++;
                        }
                    }

                    if ($count > 0) {
                        if (isset($comerciosAnomalias[$comercio])) {
                            $comerciosAnomalias[$comercio] += $count;
                        } else {
                            $comerciosAnomalias[$comercio] = $count;
                        }
                    }
                }
            }
        }

        arsort($comerciosAnomalias);
        return array_slice($comerciosAnomalias, 0, 5);
    }

    /**
     * Obtener lecturas por ciclo (mes)
     */
    private function getLecturasPorCiclo()
    {
        return DB::table('reportes')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as mes'), DB::raw('count(*) as total'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get()
            ->toArray();
    }

    /**
     * Obtener estado de reportes
     */
    private function getEstadoReportes()
    {
        return DB::table('reportes')
            ->join('vs_estado', 'reportes.estado', '=', 'vs_estado.id')
            ->select('vs_estado.nombre', DB::raw('count(*) as total'))
            ->groupBy('reportes.estado')
            ->get()
            ->toArray();
    }

    /**
     * Verificar si una anomalía debe ser excluida
     */
    private function debeExcluirAnomalia($anomalia)
    {
        if (empty($anomalia)) {
            return true;
        }

        $normalized = strtolower(trim((string)$anomalia));
        $palabrasExcluidas = ['sin anomalías', 'sin anomalia', 'ninguna', 'null', 'n/a', 'na', '-', ''];

        return in_array($normalized, $palabrasExcluidas);
    }
}
