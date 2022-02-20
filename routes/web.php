<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\ResponsabilidadSocialController;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->prefix('actividad')->controller(ActividadController::class)->group(function () {
    Route::get('/', 'index')->name('actividad.index');
    Route::get('proveer', 'proveer')->name('actividad.proveer');
    Route::get('recibidos', 'recibidos')->name('actividad.recibidos');
    Route::get('{id}/{semestre}', 'show')->name('actividad.show');
});
Route::middleware(['auth:sanctum', 'verified'])->prefix('rsu')->controller(ResponsabilidadSocialController::class)->group(function () {
    Route::get('/', 'index')->name('rsu.index');
    Route::get('{uuid}', 'show')->name('rsu.show');
});

// Para mostrar archivos subidos al servidor
Route::get('storage/{file}', function ($file) {
    return Storage::response($file);
})->name('archivos');
