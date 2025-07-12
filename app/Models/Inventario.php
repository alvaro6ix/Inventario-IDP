<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'fecha_registro',
        'serie',
        'activo_especifico',
        'resguardatario',
        'estatus',
        'estado',
        'modelo', 
        'departamento',
        'juzgado',
        'ubicacion',
        'qr_code'
    ];
}
