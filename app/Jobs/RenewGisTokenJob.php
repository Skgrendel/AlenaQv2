<?php

namespace App\Jobs;

use App\Models\GisToken;
use App\Services\coordinador\DataGisServicesToken;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RenewGisTokenJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Log::info('Iniciando renovación de token GIS...');

            $tokenService = new DataGisServicesToken();
            $newToken = $tokenService->getToken();

            if (!$newToken) {
                Log::error('No se pudo obtener el nuevo token GIS');
                return;
            }

            // Guardar el nuevo token en la BD
            $gisToken = GisToken::where('activo', true)->first();

            if (!$gisToken) {
                $gisToken = new GisToken();
                $gisToken->descripcion = 'Token GIS generado automáticamente';
            }

            $gisToken->token = $newToken;
            $gisToken->activo = true;
            $gisToken->expires_at = Carbon::now()->addMinutes(55); // Renovar cada 55 min (de 60)
            $gisToken->save();

            Log::info('Token GIS renovado exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al renovar token GIS: ' . $e->getMessage());
            throw $e;
        }
    }
}
