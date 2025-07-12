<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();  // Crea una columna 'id' autoincremental
            $table->date('fecha_registro');  // Fecha del registro
            $table->string('serie');  // Serie del inventario
            $table->string('activo_especifico');  // Identificación del activo específico
            $table->string('resguardatario');  // Responsable del activo
            $table->string('estatus');  // Estatus del inventario
            $table->string('estado');  // Estado del activo
            $table->string('modelo');  // Modelo del activo
            $table->string('departamento');  // Departamento al que pertenece el activo
            $table->string('juzgado');  // Juzgado relacionado (si aplica)
            $table->string('ubicacion');  // Ubicación del activo
            $table->timestamps();  // Campos created_at y updated_at automáticos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarios');  // Elimina la tabla 'inventarios' si existe
    }
};
