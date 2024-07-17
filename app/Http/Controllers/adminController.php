<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class adminController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->can('agente.index')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        if ($user->can('coordi.index')) {
            return redirect()->action([CoordinadorController::class, 'index']);
        }

        if ($user->can('admin.index')) {
            return redirect()->action([ReportesController::class, 'index']);
        }

        if ($user->can('audit.create')) {
            return redirect()->action([AuditoriaController::class, 'create']);
        }

        // Redirigir a una página por defecto o lanzar una excepción si no tiene ningún permiso
        //return redirect()->route('default.route'); // Asegúrate de definir esta ruta
    }
}
