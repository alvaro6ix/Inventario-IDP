<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
Route::get('/ver-logs', function () {
    $logPath = storage_path('logs/laravel.log');
    if (!file_exists($logPath)) {
        return 'No se encontró el archivo de logs.';
    }
    $logs = file_get_contents($logPath);
    return nl2br(e($logs));
});


// Ruta para la página de bienvenida (puedes cambiarla si es necesario)
Route::get('/', function () {
    return view('welcome'); // O cualquier otra vista principal que tengas
});

// Rutas para el CRUD de inventarios
Route::resource('inventarios', InventarioController::class);
