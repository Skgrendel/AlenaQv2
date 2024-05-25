<?php

namespace App\Http\Controllers;

use App\Models\personals;
use App\Models\User;
use App\Models\vs_tipo_documento;
use App\Services\personal\PersonalServices;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PersonalsController extends Controller
{
    private $store;
    public function __construct()
    {
        $this->middleware('can:coordinador');
        $this->store = new PersonalServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('personals.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipodocumento = vs_tipo_documento::pluck('nombre', 'id');
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = null;
        return view('personals.create', compact('tipodocumento', 'roles', 'userRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->store->PersonalStore($request);
        return  redirect()->route('personals.index')->with('icon', 'success')->with('success', 'Personal Creado con Exito')
            ->with('title', 'Guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(personals $personals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, User $user)
    {
        $data = $this->store->PersonalEdit($id);
        return view('personals.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $data = $this->store->PersonalUpdate($request,$id);
        return redirect()->route('personals.index')-> with('icon', 'success')->with('success', 'Personal Actualizado con Exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el registro personal
        $personal = personals::find($id);

        // Verificar si el registro personal existe
        if (!$personal) {
            // Manejar el caso cuando el registro no se encuentra
            // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
            return redirect()->back()->with('icon', 'error')->with('success', 'Registro no encontrado');
        }

        // Buscar el registro de usuario asociado con el registro personal
        $usuario = User::where('personal_id', $personal->id)->first();

        // Verificar si el registro de usuario existe
        if (!$usuario) {
            // Manejar el caso cuando el registro no se encuentra
            // Por ejemplo, puedes redirigir de vuelta con un mensaje de error
            return redirect()->back()->with('icon', 'error')->with('success', 'Registro no encontrado');
        }

        // Actualizar la propiedad estado para ambos registros
        $personal->estado = 0;
        $personal->save();

        $usuario->estado = 0;
        $usuario->save();


        // Redirigir a la ruta de índice
        return redirect()->route('personals.index')->with('icon', 'success')->with('success', 'Personal Eliminado con Exito');
    }
}
