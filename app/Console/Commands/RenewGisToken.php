<?php

namespace App\Console\Commands;

use App\Jobs\RenewGisTokenJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;

class RenewGisToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gis:renew-token';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Renovar el token GIS automáticamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Disparando renovación de token GIS...');

        Queue::dispatch(new RenewGisTokenJob());

        $this->info('✅ Job de renovación de token GIS encolado exitosamente');
    }
}
