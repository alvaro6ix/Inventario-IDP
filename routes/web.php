<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

// Ruta para la página de bienvenida (puedes cambiarla si es necesario)
Route::get('/', function () {
    return view('welcome'); // O cualquier otra vista principal que tengas
});

// Rutas para el CRUD de inventarios
Route::resource('inventarios', InventarioController::class);
