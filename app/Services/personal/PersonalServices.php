<?php

namespace App\Services\personal;

use App\Models\personals;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\vs_tipo_documento;
use Illuminate\Support\Facades\Request;

class PersonalServices
{
    public function PersonalStore($request){

        // Validación de datos
        $request->validate(personals::$rules);

        // Validar existencia de personal por número de documento
        $userCorreo = $request['correo'];
        $userRol = $request['rol'];
        $existingPersonal = personals::where('numero_documento', $request->input('numero_documento'))->first();

        if ($existingPersonal) {
            // Si ya existe personal con ese número de documento, muestra un mensaje de error y redirige
            return redirect()->back()->with('success', 'Ya existe un personal con este número de documento.')->with('title', 'Error');
        }
        // Si no existe, crea el personal
        $data = $request->all();
        $personal = personals::create($data);
        $personal_id = $personal->id;

        // Crear usuario
        $user = new User([
            'email' => $userCorreo,
            'password' => bcrypt($request['numero_documento']),
        ]);

        // Asignar roles al usuario
        $Role = Role::where('name', $userRol)->first();
        $user->assignRole($Role);

        // Asociar usuario al personal creado
        $user->personal_id = $personal_id; //
        $user->save();

    }

    public function PersonalEdit($id){
         // Buscar el registro personal
         $personal = personals::find($id);
         // Buscar el registro de usuario asociado con el registro personal
         $roles = Role::pluck('name', 'name')->all();
         $user = User::where('personals_id', $personal->id)->first();
         // Verificar si el registro de usuario existe
         $userRoles = $user->roles->pluck('name')->toArray();
         // Verificar si el registro de usuario existe
         $tipodocumento = vs_tipo_documento::pluck('nombre', 'id');

         return[
            'personal'=>$personal,
            'roles'=>$roles,
            'user'=>$user,
            'userRoles'=>$userRoles,
            'tipodocumento'=>$tipodocumento
         ];
    }

    public function PersonalUpdate($request,  $id){

        $personal = personals::find($id);

        if ($personal) {
            $personal->update($request->all());

            // Buscar el registro de usuario asociado con el registro personal
            $user = User::where('personal_id', $personal->id)->first();

            // Verificar si el registro de usuario existe
            if ($user) {
                $user->update([
                    'email' => $request['correo'],
                ]);

                // Asignar roles al usuario
                $user->syncRoles($request['rol']);
            }
           
        }

    }
}
