<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea un permiso de ejemplo
        Permission::create([
            'name' => 'administrador',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
        Permission::create([
            'name' => 'coordinador',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
        Permission::create([
            'name' => 'agente',
            'guard_name' => 'web',
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);
    }
}
