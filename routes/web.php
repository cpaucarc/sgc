<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\ResponsabilidadSocialController;
use App\Http\Controllers\TituloProfesionalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rutas protegidas solo para usuarios autenticados
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('actividad')->controller(ActividadController::class)->group(function () {
        Route::get('/', 'index')->name('actividad.index');
        Route::get('proveer', 'proveer')->name('actividad.proveer');
        Route::get('recibidos', 'recibidos')->name('actividad.recibidos');
        Route::get('ver/{id}/{semestre}', 'show')->name('actividad.show');
    });

    Route::prefix('rsu')->controller(ResponsabilidadSocialController::class)->group(function () {
        Route::get('/', 'index')->name('rsu.index');
        Route::get('crear', 'create')->name('rsu.create');
        Route::get('ver/{uuid}', 'show')->name('rsu.show');
    });

    Route::prefix('tpu')->controller(TituloProfesionalController::class)->group(function () {
        Route::get('/', 'index')->name('tpu.index');
        Route::get('solicitud', 'request')->name('tpu.request');
        Route::get('solicitud/{solicitud}', 'tesis')->name('tpu.tesis');
        Route::get('solicitud/{solicitud}/{tesis}', 'seeTesis')->name('tpu.seeTesis');
        Route::get('solicitudes', 'requests')->name('tpu.requests');
    });

    Route::prefix('indicador')->controller(IndicadorController::class)->group(function () {
        Route::get('/', 'index')->name('indicador.index');
        Route::get('proceso/{proceso}/{uuid}', 'proceso')->name('indicador.proceso'); //proceso:nombre | uuid:escuela,facultad
    });

});

//Para mostrar encuestas
Route::prefix('encuestas')->controller(EncuestaController::class)->group(function () {
    Route::get('rsu/{uuid}', 'rsu')->name('encuesta.rsu');
});

// Para mostrar archivos subidos al servidor
Route::get('storage/{file}', function ($file) {
    return Storage::response($file);
})->name('archivos');
