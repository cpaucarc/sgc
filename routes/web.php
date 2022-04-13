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
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ResponsabilidadSocialController;
use App\Http\Controllers\TituloProfesionalController;
use Illuminate\Support\Facades\Http;
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
    return redirect()->route('login');
});

Route::get('/prueba', function () {
    $rsp = env('OGE_API');
    $escuela_id = 11;
    $semestre = '2021-2';
    $rsp1 = Http::withToken(env('OGE_TOKEN'))
        ->get('http://sga.unasam.edu.pe/api/indicadores/ensenianza_aprendizaje/escuela/13?escuela=13&semestre=2022-0');
    return $rsp1;
});

//Rutas protegidas solo para usuarios autenticados
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.panel.index');
        Route::get('escuela', 'escuelas')->name('admin.panel.escuelas');
        Route::get('facultad', 'facultades')->name('admin.panel.facultades');
        Route::get('proceso', 'procesos')->name('admin.panel.procesos');
        Route::get('actividad', 'actividades')->name('admin.panel.actividades');
        Route::get('entrada', 'entradas')->name('admin.panel.entradas');
        Route::get('salida', 'salidas')->name('admin.panel.salidas');
        Route::get('entidad', 'entidades')->name('admin.panel.entidades');
        Route::get('usuario', 'usuarios')->name('admin.panel.usuarios');
        Route::get('usuario/ver/{uuid}', 'usuario')->name('admin.panel.usuario');
        Route::get('entidad/responsable/{id}', 'entidad_responsable')->name('admin.panel.entidad.responsable');
        Route::get('entidad/proveedor/{id}', 'entidad_proveedor')->name('admin.panel.entidad.proveedor');
        Route::get('entidad/cliente/{id}', 'entidad_cliente')->name('admin.entidad.cliente');
    });

    Route::prefix('reporte')->controller(ReporteController::class)->group(function () {
        /*Todo: Convenio*/
        Route::get('convenio', 'convenio')->name('reporte.convenio');
        Route::get('convenio/pdf', 'convenio_reporte')->name('reporte.convenio.pdf');

        /*Todo: Convalidacion*/
        Route::get('convalidacion', 'convalidacion')->name('reporte.convalidacion');
        Route::get('convalidacion/pdf', 'convalidacion_reporte')->name('reporte.convalidacion.pdf');

        /*Todo: Indicador */
        Route::get('indicador', 'indicador')->name('reporte.indicador');
        Route::get('indicador/pdf', 'indicador_reporte')->name('reporte.indicador.pdf');
        Route::get('indicador/detalle/pdf', 'indicador_por_indicador')->name('reporte.detalle.pdf');

        /*Todo: Responsabilidad Social*/
        Route::get('rsu', 'rsu')->name('reporte.rsu');
        Route::get('rsu/pdf', 'rsu_reporte')->name('reporte.rsu.pdf');

        /*Todo: Investigacion */
        Route::get('investigacion', 'investigacion')->name('reporte.investigacion');
        Route::get('investigacion/pdf', 'investigacion_reporte')->name('reporte.investigacion.pdf');

        /*Todo: Auditoria */
        Route::get('auditoria', 'auditoria')->name('reporte.auditoria');
        Route::get('auditoria/pdf', 'auditoria_reporte')->name('reporte.auditoria.pdf');

        /*Todo: Biblioteca*/
        Route::get('biblioteca', 'biblioteca')->name('reporte.biblioteca');
        Route::get('biblioteca/material/pdf', 'biblioteca_reporte_material')->name('reporte.biblioteca.material.pdf');
        Route::get('biblioteca/visitante/pdf', 'biblioteca_reporte_visitante')->name('reporte.biblioteca.visitante.pdf');

        /*Todo: Bolsa de trabajo*/
        Route::get('bolsa', 'bolsa')->name('reporte.bolsa');
        Route::get('bolsa/pdf', 'bolsa_reporte')->name('reporte.bolsa.pdf');

        /*Todo: Bienestar Universitario*/
        Route::get('bienestar-universitario', 'bienestar')->name('reporte.bienestar');
        Route::get('bienestar-universitario/pdf', 'bienestar_reporte')->name('reporte.bienestar.pdf');
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

// Para mostrar PDF generado con DomPDF
//Route::get('storage/{file}', function ($file) {
//    return Storage::response($file);
//})->name('archivos');
