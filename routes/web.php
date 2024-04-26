<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\FuntionController;
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
    Route::get('/funtion/busqueda/{id}', [FuntionController::class,'BuscarContrato'])->name('Contrato');
    Route::resource('/reportes', ReportesController::class)->names('reportes');
});
