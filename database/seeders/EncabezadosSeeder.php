<?php

namespace Database\Seeders;

use App\Models\encabezados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncabezadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // parametros de opciones de
        encabezados::create([
            'nombre'=>'Tipo de Documento',
        ]);
        encabezados::create([
            'nombre'=>'estado',
        ]);
        encabezados::create([
            'nombre'=>'anomalia',
        ]);
        encabezados::create([
            'nombre'=>'tipo_comercio',
        ]);
        encabezados::create([
            'nombre'=>'imposibilidad',
        ]);

        }
}
