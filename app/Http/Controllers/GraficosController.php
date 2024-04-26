<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\reportes;
use App\Models\vs_anomalias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficosController extends Controller
{
    public function ConteoRegistrosxDia()
    {
        //variables para obtener la fecha actual y el rango de la semana
        $today = date('Y-m-d');
        $inicioSemana = date('Y-m-d', strtotime('monday this week'));
        $finSemana = date('Y-m-d', strtotime('sunday this week'));

        // Consulta para obtener el conteo de reportes por día de la semana
        $dia = DB::table('reportes')
            ->select(DB::raw("count(*) as count,
        CASE
            WHEN DAYOFWEEK(created_at) = 1 THEN 'Domingo'
            WHEN DAYOFWEEK(created_at) = 2 THEN 'Lunes'
            WHEN DAYOFWEEK(created_at) = 3 THEN 'Martes'
            WHEN DAYOFWEEK(created_at) = 4 THEN 'Miércoles'
            WHEN DAYOFWEEK(created_at) = 5 THEN 'Jueves'
            WHEN DAYOFWEEK(created_at) = 6 THEN 'Viernes'
            WHEN DAYOFWEEK(created_at) = 7 THEN 'Sábado'
        END as day,
        DAYOFWEEK(created_at) as day_number"))
            ->whereBetween('created_at', [$inicioSemana, $finSemana])
            ->groupBy('day', 'day_number')
            ->orderBy('day_number', 'asc')
            ->get();
        // fin de la consulta


        //consulta para obtener el conteo de anomalías por día
        $anomalis = DB::table('reportes')
            ->whereDate('created_at', $today)
            ->select('anomalia', 'created_at')
            ->get();

        $counts = [];
        $anomaliaNames = [];

        foreach ($anomalis as $row) {
            $anomalias = json_decode($row->anomalia);
            foreach ($anomalias as $anomalia) {
                if (!isset($counts[$anomalia])) {
                    $counts[$anomalia] = 0;
                    // Aquí utilizamos la relación para obtener el nombre de la anomalía
                    $anomaliaNames[$anomalia] = vs_anomalias::find($anomalia)->nombre;
                }
                $counts[$anomalia]++;
            }
        }


        $anomalia = []; // Aquí combinamos los nombres de las anomalías con sus respectivos conteos
        $anomalies = []; // Aquí guardaremos los datos de las anomalías

        foreach ($counts as $anomalia => $count) {
            $anomalies[] = ['nombre' => $anomaliaNames[$anomalia], 'count' => $count];
        }
        // fin de la consulta

        //consulta para obtener el conteo de reportes por personal
        $personals = DB::table('reportes')
            ->join('personals', 'reportes.personal_id', '=', 'personals.id') // Unir con la tabla personals
            ->whereDate('reportes.created_at', '=', date('Y-m-d')) // Filtrar por la fecha actual
            ->select(DB::raw("count(*) as count, personal_id, personals.nombres as personal_name")) // Incluir el nombre del personal
            ->groupBy('personal_id')
            ->get();

        // fin de la consulta


        return view('informes.informeDia', compact('dia', 'anomalies', 'personals', 'today'));
    }

    public function ReportesTotalesxmes()
    {
        $reportes =  DB::table('reportes')
            ->select(DB::raw("count(lectura) as total,
    CASE
        WHEN MONTH(created_at) = 1 THEN 'Enero'
        WHEN MONTH(created_at) = 2 THEN 'Febrero'
        WHEN MONTH(created_at) = 3 THEN 'Marzo'
        WHEN MONTH(created_at) = 4 THEN 'Abril'
        WHEN MONTH(created_at) = 5 THEN 'Mayo'
        WHEN MONTH(created_at) = 6 THEN 'Junio'
        WHEN MONTH(created_at) = 7 THEN 'Julio'
        WHEN MONTH(created_at) = 8 THEN 'Agosto'
        WHEN MONTH(created_at) = 9 THEN 'Septiembre'
        WHEN MONTH(created_at) = 10 THEN 'Octubre'
        WHEN MONTH(created_at) = 11 THEN 'Noviembre'
        WHEN MONTH(created_at) = 12 THEN 'Diciembre'
    END as month,
    MONTH(created_at) as month_number"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month', 'month_number')
            ->orderBy('month_number', 'asc')
            ->get();


        return view('informes.informeGeneral', compact('reportes'));
    }

    public function ReportesFilter(Request $request)
    {
        $personals = $request->input('personal');
        $inicio = $request->input('desde');
        $fin = $request->input('hasta');

        $reportes =  DB::table('reportes')
            ->select(DB::raw("count(lectura) as total,DATE(created_at) as fecha"));

        if (!empty($personals)) {
            $reportes = $reportes->where('personal_id', $personals);
        }

        if (!empty($inicio) && !empty($fin)) {
            $reportes = $reportes->whereBetween('created_at', [$inicio, $fin]);
        }

        $reportes = $reportes->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'asc')
            ->get();

        return json_encode($reportes);
    }

    public function TiempoPersonal(Request $request)
    {
            $personal_id = $request->input('personalMin');

            $resultados = DB::select('
            SELECT personal_id,
                   AVG(TIMESTAMPDIFF(SECOND, created_at, previous_reading)) AS avg_time_between_readings
            FROM (
                SELECT personal_id,
                       created_at,
                       LAG(created_at) OVER (PARTITION BY personal_id ORDER BY created_at) AS previous_reading
                FROM reportes
            ) AS t
            WHERE personal_id = ?
            GROUP BY personal_id
        ', [$personal_id]);

            return json_encode($resultados);
    }

}
