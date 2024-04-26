<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario de Administrador Predeterminado
        $user = User::create([
            'email' => 'admin@proderi.com',
            'personal_id'=>'1',
            'password' => bcrypt('0000.**'), // Cambia esto por la contraseña que desees
            'estado' => 1, // Ajusta el valor según tus necesidades
        ]);

        // Asigna el rol de administrador al usuario
        $Role = Role::where('name', 'administrador')->first();
        $user->assignRole($Role);


    }
}
