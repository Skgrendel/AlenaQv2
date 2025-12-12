<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AsignadosController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ConfiguracionesController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\GisTokenController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SurtugasController;
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
    Route::get('/asignados', [AsignadosController::class, 'Asignados'])->name('asignados');
    Route::get('/entregados', [AsignadosController::class, 'Entregados'])->name('entregados');
    Route::get('/asignados', [AsignadosController::class,'Asignados'])->name('asignados');
    Route::get('/entregados', [AsignadosController::class,'Entregados'])->name('entregados');

    // Rutas para gestión de surtigas pendientes
    Route::get('/surtigas/pendientes', [SurtugasController::class, 'pendientes'])->name('surtigas.pendientes');
    Route::get('/surtigas/asignar/{id}', [SurtugasController::class, 'asignar'])->name('surtigas.asignar');
    Route::post('/surtigas/asignar/{id}', [SurtugasController::class, 'guardarAsignacion'])->name('surtigas.guardar-asignacion');
    Route::get('/surtigas/asignar-masivo', [SurtugasController::class, 'asignarMasivo'])->name('surtigas.asignar-masivo');
    Route::post('/surtigas/asignar-masivo', [SurtugasController::class, 'guardarAsignacionMasiva'])->name('surtigas.guardar-asignacion-masiva');
    Route::get('/surtigas/exportar-pendientes', [SurtugasController::class, 'exportarPendientes'])->name('surtigas.exportar-pendientes');

    Route::resource('/coordinador', CoordinadorController::class)->names('coordinador')->except(['create']);
    Route::post('/personals/{id}/activate', [PersonalsController::class, 'activate'])->name('personals.activate');
    Route::resource('/personals', PersonalsController::class)->names('personals');
    Route::get('/admin', adminController::class)->name('admin');
    Route::get('/informes', [InformesController::class, 'InfoGeneral'])->name('informes');
    Route::get('show/reporte/{id}', [ReportesController::class, 'showreporte'])->name('showreportes');
    Route::resource('/auditorias', AuditoriaController::class)->names('auditorias');
    Route::resource('Roles', RolesController::class)->names('roles');
    Route::resource('/config', ConfiguracionesController::class)->names('configs');

    // Rutas para gestión de tokens GIS
    Route::resource('/gis-tokens', GisTokenController::class)->names('gis-tokens');
    Route::patch('/gis-tokens/{gisToken}/activate', [GisTokenController::class, 'activate'])->name('gis-tokens.activate');

    Route::get('/generar-reportes-zip', [ReportesController::class, 'descargarZipReportes'])->name('reportes.zip');
    Route::get('/Rechazar/{id}', [ReportesController::class, 'Rechazar'])->name('Rechazar');
    Route::get('/check-connection', function () {
        return response()->json(['status' => 'ok'], 200);
    });

});
