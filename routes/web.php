<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

// Ruta para la página de bienvenida (puedes cambiarla si es necesario)

Route::get('/status', function () {
    try {
        \Illuminate\Support\Facades\DB::connection()->getPdo();
        return '✅ Laravel está conectado a la base de datos y vivo.';
    } catch (\Exception $e) {
        return '❌ Error de conexión: ' . $e->getMessage();
    }
});


// Rutas para el CRUD de inventarios
Route::resource('inventarios', InventarioController::class);
