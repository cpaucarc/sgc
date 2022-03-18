<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\BachillerController;
use App\Http\Controllers\BolsaTrabajoController;
use App\Http\Controllers\ComedorController;
use App\Http\Controllers\ConvalidacionController;
use App\Http\Controllers\BibliotecaController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\IndicadorController;
use App\Http\Controllers\InvestigacionController;
use App\Http\Controllers\PlanEstudiosController;
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

    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.index');
        Route::get('escuela', 'escuelas')->name('admin.escuelas');
        Route::get('facultad', 'facultades')->name('admin.facultades');
        Route::get('proceso', 'procesos')->name('admin.procesos');
        Route::get('actividad', 'actividades')->name('admin.actividades');
        Route::get('entrada', 'entradas')->name('admin.entradas');
        Route::get('salida', 'salidas')->name('admin.salidas');
        Route::get('entidad', 'entidades')->name('admin.entidades');
        Route::get('usuario', 'usuarios')->name('admin.usuarios');
        Route::get('usuario/ver/{uuid}', 'usuario')->name('admin.usuario');
        Route::get('entidad/responsable/{id}', 'entidad_responsable')->name('admin.entidad.responsable');
        Route::get('entidad/proveedor/{id}', 'entidad_proveedor')->name('admin.entidad.proveedor');
        Route::get('entidad/cliente/{id}', 'entidad_cliente')->name('admin.entidad.cliente');
    });

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

    Route::prefix('bachiller')->controller(BachillerController::class)->group(function () {
        Route::get('/', 'index')->name('bachiller.index');
        Route::get('solicitud', 'request')->name('bachiller.request');
        Route::get('solicitudes', 'requests')->name('bachiller.requests');
    });

    Route::prefix('investigacion')->controller(InvestigacionController::class)->group(function () {
        Route::get('/', 'index')->name('investigacion.index');
        Route::get('ver/{uuid}', 'show')->name('investigacion.show');
    });

    Route::prefix('convalidacion')->controller(ConvalidacionController::class)->group(function () {
        Route::get('/', 'index')->name('convalidacion.index');
        Route::get('registrar', 'registrarConvalidacion')->name('convalidacion.registrar');
    });

    Route::prefix('convenio')->controller(ConvenioController::class)->group(function () {
        Route::get('/', 'index')->name('convenio.index');
        Route::get('registrar', 'registrarConvenio')->name('convenio.registrar');
    });

    Route::prefix('btu')->controller(BolsaTrabajoController::class)->group(function () {
        Route::get('/', 'index')->name('btu.index');
        Route::get('registrar/postulante', 'registrarPostulante')->name('btu.registrar.postulante');
    });

    Route::prefix('biblioteca')->controller(BibliotecaController::class)->group(function () {
        Route::get('/', 'index')->name('biblioteca.index');
        Route::get('registrar/material', 'registrarMaterial')->name('biblioteca.registrar.material');
        Route::get('registrar/visitante', 'registrarVisitante')->name('biblioteca.registrar.visitante');
    });

    Route::prefix('indicador')->controller(IndicadorController::class)->group(function () {
        Route::get('/', 'index')->name('indicador.index');
        Route::get('proceso/{proceso_id}/{tipo}/{uuid}', 'proceso')->name('indicador.proceso'); //proceso:id | tipo:1-escuela,2-facultad | uuid:escuela,facultad
        Route::get('ver/{indicador_id}/{tipo}/{uuid}', 'indicador')->name('indicador.indicador'); //proceso:id | tipo:1-escuela,2-facultad | uuid:escuela,facultad
    });

    Route::prefix('auditoria')->controller(AuditoriaController::class)->group(function () {
        Route::get('/', 'index')->name('auditoria.index');
        Route::get('crear', 'create')->name('auditoria.create');
    });

    Route::prefix('bienestar-universitario')->controller(ComedorController::class)->group(function () {
        Route::get('/', 'index')->name('bienestar.index');
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
