<?php

namespace Database\Seeders;

use App\Models\surtigas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SurtugasTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear algunos surtigas de prueba con estado = 1 (pendiente) y sin personals_id
        $surtigasData = [
            [
                'personals_id' => null,
                'contrato' => 'TEST001',
                'cliente' => 'Cliente Prueba 1',
                'direccion' => 'Calle 1 #100',
                'barrio' => 'Centro',
                'medidor' => 'MED001',
                'latitud' => '4.7110',
                'longitud' => '-74.0721',
                'ciclo' => '1001',
                'estado' => 1,
                'estado_servicio' => 1,
            ],
            [
                'personals_id' => null,
                'contrato' => 'TEST002',
                'cliente' => 'Cliente Prueba 2',
                'direccion' => 'Calle 2 #200',
                'barrio' => 'Oriente',
                'medidor' => 'MED002',
                'latitud' => '4.7111',
                'longitud' => '-74.0722',
                'ciclo' => '1001',
                'estado' => 1,
                'estado_servicio' => 1,
            ],
            [
                'personals_id' => null,
                'contrato' => 'TEST003',
                'cliente' => 'Cliente Prueba 3',
                'direccion' => 'Calle 3 #300',
                'barrio' => 'Occidente',
                'medidor' => 'MED003',
                'latitud' => '4.7112',
                'longitud' => '-74.0723',
                'ciclo' => '1002',
                'estado' => 1,
                'estado_servicio' => 1,
            ],
            [
                'personals_id' => null,
                'contrato' => 'TEST004',
                'cliente' => 'Cliente Prueba 4',
                'direccion' => 'Calle 4 #400',
                'barrio' => 'Norte',
                'medidor' => 'MED004',
                'latitud' => '4.7113',
                'longitud' => '-74.0724',
                'ciclo' => '1002',
                'estado' => 1,
                'estado_servicio' => 1,
            ],
            [
                'personals_id' => null,
                'contrato' => 'TEST005',
                'cliente' => 'Cliente Prueba 5',
                'direccion' => 'Calle 5 #500',
                'barrio' => 'Sur',
                'medidor' => 'MED005',
                'latitud' => '4.7114',
                'longitud' => '-74.0725',
                'ciclo' => '1003',
                'estado' => 1,
                'estado_servicio' => 1,
            ],
        ];

        foreach ($surtigasData as $data) {
            surtigas::firstOrCreate(
                ['contrato' => $data['contrato']],
                $data
            );
        }

        $this->command->info('Surtigas de prueba creados exitosamente!');
    }
}
