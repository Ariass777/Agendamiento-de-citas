<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AgendarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ServicioController;

/*
|--------------------------------------------------------------------------
| RUTAS WEB - SISTEMA DE CITAS
|--------------------------------------------------------------------------
*/

/* Página principal: ahora apunta a agendar.index (página informativa) */
Route::get('/', [AgendarController::class, 'index'])->name('agendar.index');

/* AGENDAR CITAS (CLIENTE) */
Route::get('/agendar/create', [AgendarController::class, 'create'])->name('agendar.create');
Route::post('/agendar', [AgendarController::class, 'store'])->name('agendar.store');

/* APIs públicas para dinámicos */
Route::get('/servicios/{id}/estilistas', [ServicioController::class, 'getEstilistas'])->name('servicios.estilistas');
Route::get('/get-dias/{usuario_id}', [AgendarController::class, 'getDiasDisponibles'])->name('get.dias');
Route::get('/get-horas/{usuario_id}/{dia}', [AgendarController::class, 'getHorasDisponibles'])->name('get.horas');
Route::delete('/agendar/{id}', [AgendarController::class, 'destroy'])->name('agendar.destroy');

/* TIENDA / CHECKOUT */
Route::get('/tienda', [TiendaController::class, 'index'])->name('tienda.index');
// Muestra el formulario de datos del cliente
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Procesa el pago y redirige a Mercado Pago (POST)
Route::post('/process-checkout', [CheckoutController::class, 'processOrder'])->name('checkout.process');
// Rutas de retorno
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/failure', [CheckoutController::class, 'failure'])->name('checkout.failure');
Route::get('/checkout/pending', [CheckoutController::class, 'pending'])->name('checkout.pending');

/* AUTH y ADMIN  */
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // ... Rutas de Admin ...
    Route::prefix('admin/usuarios')->group(function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/create', [UsuarioController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/create', [UsuarioController::class, 'store'])->name('admin.usuarios.store');
        Route::get('/{id}', [UsuarioController::class, 'show'])->name('admin.usuarios.show');
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update');
        Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    });

    Route::prefix('admin/clientes')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('admin.clientes.index');
        Route::get('/create', [ClienteController::class, 'create'])->name('admin.clientes.create');
        Route::post('/create', [ClienteController::class, 'store'])->name('admin.clientes.store');
        Route::get('/{id}', [ClienteController::class, 'show'])->name('admin.clientes.show');
        Route::get('/{id}/edit', [ClienteController::class, 'edit'])->name('admin.clientes.edit');
        Route::put('/{id}', [ClienteController::class, 'update'])->name('admin.clientes.update');
        Route::delete('/{id}', [ClienteController::class, 'destroy'])->name('admin.clientes.destroy');
    });

    Route::prefix('admin/horarios')->group(function () {
        Route::get('/', [HorarioController::class, 'index'])->name('admin.horarios.index');
        Route::get('/create', [HorarioController::class, 'create'])->name('admin.horarios.create');
        Route::post('/create', [HorarioController::class, 'store'])->name('admin.horarios.store');
        Route::get('/{id}/edit', [HorarioController::class, 'edit'])->name('admin.horarios.edit');
        Route::put('/{id}', [HorarioController::class, 'update'])->name('admin.horarios.update');
        Route::delete('/{id}', [HorarioController::class, 'destroy'])->name('admin.horarios.destroy');
        Route::get('/{id}', [HorarioController::class, 'show'])->name('admin.horarios.show');
    });

    Route::prefix('admin/citas')->group(function () {
        Route::get('/', [CitaController::class, 'index'])->name('admin.citas.index');
        Route::get('/{id}', [CitaController::class, 'show'])->name('admin.citas.show');
        Route::put('/{id}', [CitaController::class, 'update'])->name('admin.citas.update');
        Route::delete('/{id}', [CitaController::class, 'destroy'])->name('admin.citas.destroy');
    });
});
