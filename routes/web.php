<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\AsignadosController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\FuntionController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PersonalsController;
use App\Http\Controllers\ReportesController;
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
    Route::resource('/reportes', ReportesController::class)->names('reportes');
    Route::resource('/asignados', AsignadosController::class)->names('asignados');
    Route::resource('/coordinador', CoordinadorController::class)->names('coordinador');
    Route::resource('/personals', PersonalsController::class)->names('personals');
    Route::get('/admin', adminController::class)->name('admin');
    Route::post('/addcomercio', [ReportesController::class, 'addcomercio'])->name('addcomercio');
    Route::get('/busqueda', [DireccionesController::class, 'index'])->name('busqueda');
    Route::get('/informes', [InformesController::class, 'InfoGeneral'])->name('informes');
});
