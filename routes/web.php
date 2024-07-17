<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AsignadosController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RolesController;
use App\Models\configuraciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::middleware('check_user_status')->group(function () {
    Route::get('/home', adminController::class)->name('home');
    Route::resource('/reportes', ReportesController::class)->names('reportes')->except(['destroy', 'create']);
    Route::get('/asignados', [AsignadosController::class,'Asignados'])->name('asignados');
    Route::get('/entregados', [AsignadosController::class,'Entregados'])->name('entregados');
    Route::resource('/coordinador', CoordinadorController::class)->names('coordinador')->except(['create']);
    Route::resource('/personals', PersonalsController::class)->names('personals');
    Route::get('/admin', adminController::class)->name('admin');
    Route::get('/informes', [InformesController::class, 'InfoGeneral'])->name('informes');
    Route::get('show/reporte/{id}', [ReportesController::class, 'showreporte'])->name('showreportes');
    Route::resource('/auditorias', AuditoriaController::class)->names('auditorias');
    Route::resource('Roles', RolesController::class)->names('roles');
    Route::resource('/config', ConfiguracionesController::class)->names('configs');
    Route::get('/check-connection', function () {
        return response()->json(['status' => 'ok'], 200);
    });

});
