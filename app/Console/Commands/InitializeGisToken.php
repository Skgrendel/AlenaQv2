<?php

namespace App\Console\Commands;

use App\Models\GisToken;
use App\Services\coordinador\DataGisServicesToken;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InitializeGisToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gis:initialize-token';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Generar e inicializar el token GIS por primera vez';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Inicializando token GIS...');

        try {
            $tokenService = new DataGisServicesToken();
            $token = $tokenService->getToken();

            if (!$token) {
                $this->error('❌ No se pudo obtener el token GIS');
                return Command::FAILURE;
            }

            // Crear o actualizar token en BD
            GisToken::updateOrCreate(
                ['activo' => true],
                [
                    'token' => $token,
                    'descripcion' => 'Token GIS - Inicializado',
                    'expires_at' => Carbon::now()->addMinutes(55)
                ]
            );

            $this->info('✅ Token GIS inicializado exitosamente');
            $this->info('⏰ Expira en: ' . Carbon::now()->addMinutes(55)->format('Y-m-d H:i:s'));

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            Log::error('Error al inicializar token GIS: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
