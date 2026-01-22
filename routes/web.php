<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PlanLicenciaController;
use App\Http\Controllers\SuscripcionController;
use App\Http\Controllers\CorreoAlertaController;
use App\Http\Controllers\AlertaEnviadaController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página pública
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protegido)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
/*
|--------------------------------------------------------------------------
| Rutas autenticadas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Perfil de usuario (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ====== PANEL ADMIN ======
    Route::resource('clientes', ClienteController::class);
    Route::resource('planes-licencias', PlanLicenciaController::class);
    Route::resource('suscripciones', SuscripcionController::class);
    Route::resource('correos-alertas', CorreoAlertaController::class);

    // Alertas enviadas (solo lectura)
    Route::get('alertas-enviadas', [AlertaEnviadaController::class, 'index'])
        ->name('alertas-enviadas.index');
    Route::patch(
    'planes-licencias/{planes_licencia}/toggle',
    [PlanLicenciaController::class, 'toggleActivo']
        )->name('planes-licencias.toggle');

});

// Rutas de autenticación (login, register, etc.)
require __DIR__ . '/auth.php';
