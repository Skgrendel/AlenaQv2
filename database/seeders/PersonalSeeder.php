<?php

namespace Database\Seeders;

use App\Models\Personals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Personal de Administrador Predeterminado
        $personal = personals::create([
            'tipo_documento'=>'1',
            'numero_documento'=>'0000',
            'nombres'=>'Administrador',
            'apellidos'=>'Sistema',
            'correo'=>'admin@proderi.com',
            'estado'=>'3'
        ]);


    }
}
