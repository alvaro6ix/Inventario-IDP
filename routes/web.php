<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;
Route::get('/', function () {
    return '✅ Inventario-IDP está corriendo. Ruta / activa.';
});
