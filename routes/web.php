<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Artisan;

Route::get('/migrar', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return '✅ Migraciones ejecutadas correctamente.';
    } catch (Exception $e) {
        return '❌ Error al ejecutar migraciones: ' . $e->getMessage();
    }
});


// Ruta para la página de bienvenida (puedes cambiarla si es necesario)
Route::get('/', function () {
    return view('welcome'); // O cualquier otra vista principal que tengas
});

// Rutas para el CRUD de inventarios
Route::resource('inventarios', InventarioController::class);
