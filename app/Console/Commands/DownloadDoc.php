<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CoordinadorController;
use App\Models\reportes;
use App\Models\surtigas;
use App\Models\vs_anomalias;

class DownloadDoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-doc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $this->info('inicio');
            // Obtener los valores que coinciden con los contratos en el array
            $surtigas = surtigas::where('ciclo', '2001')->get();
            $reportes = reportes::whereIn('surtigas_id', $surtigas->pluck('id'))->get();
            $controlador = new CoordinadorController();

            foreach ($reportes as $reporte) {
                $this->info('Descargando contrato #' . $reporte->contrato);
                $controlador->exportdoc($reporte->id);
                $this->info('Descargando');
            }
            $this->info('terminado');
        } catch (\Throwable $th) {
            $this->error('error ' . $th->getMessage());
        }

    }
}
