<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicioController;
use App\Http\Controllers\Api\UserController; // estilistas
use App\Http\Controllers\Api\HorarioController;
use App\Http\Controllers\Api\ReservaController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// -------------------------------
// API para agendamiento
// -------------------------------

//  Listar servicios disponibles
Route::get('/servicios', [ServicioController::class, 'index']);

//  Obtener estilistas que ofrecen un servicio
Route::get('/servicios/{servicio}/estilistas', [UserController::class, 'estilistasPorServicio']);

//  Obtener horarios disponibles del estilista
Route::get('/estilistas/{user}/horarios', [HorarioController::class, 'disponibles']);

//  Registrar una reserva (cliente debe estar logueado)
Route::post('/reservas', [ReservaController::class, 'store']);
