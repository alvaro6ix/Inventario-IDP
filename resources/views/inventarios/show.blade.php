@extends('layouts.app')

@section('content')
<div class="container mx-auto p-3 bg-pantone504 rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-pantoneWarmGrey1 mb-6">Detalle del Inventario</h1>

    <table class="min-w-full bg-pantoneWarmGrey1 border border-pantoneBlack6 rounded-lg overflow-hidden">
        <tbody>
            <tr>
                <th class="py-2 px-4 bg-pantone7504 text-left">Fecha de Registro</th>
                <td class="py-2 px-4">{{ \Carbon\Carbon::parse($inventario->fecha_registro)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone467 text-left">Serie</th>
                <td class="py-2 px-4">{{ $inventario->serie }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone7504 text-left">Activo Específico</th>
                <td class="py-2 px-4">{{ $inventario->activo_especifico }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone467 text-left">Resguardatario</th>
                <td class="py-2 px-4">{{ $inventario->resguardatario }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone7504 text-left">Estatus</th>
                <td class="py-2 px-4">{{ $inventario->estatus }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone467 text-left">Estado</th>
                <td class="py-2 px-4">{{ $inventario->estado }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone7504 text-left">Modelo</th>
                <td class="py-2 px-4">{{ $inventario->modelo }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone467 text-left">Departamento</th>
                <td class="py-2 px-4">{{ $inventario->departamento }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone7504 text-left">Juzgado</th>
                <td class="py-2 px-4">{{ $inventario->juzgado }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-pantone467 text-left">Ubicación</th>
                <td class="py-2 px-4">{{ $inventario->ubicacion }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Mostrar el código QR -->
    <div class="mt-1">
    <h2 class="text-xl font-semibold text-gray-100">Código QR</h2>
    <div class="flex justify-center mt-.1">
        <img src="{{ asset($inventario->qr_code) }}" alt="Código QR">
    </div>
</div>
    <div class="mt-1">
        <a href="{{ route('inventarios.index') }}" class="inline-block bg-pantone7504 text-white py-2 px-4 rounded-md hover:bg-pantone467">Regresar al Inventarior</a>
    </div>
</div>
@endsection
