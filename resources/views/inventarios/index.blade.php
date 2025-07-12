@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-pantoneWarmGrey1 mb-3">Inventarios</h1>

    <a href="{{ route('inventarios.create') }}" class="bg-pantone7504 text-white py-2 px-4 rounded-md hover:bg-pantone7504 mb-4 inline-block">Agregar Nuevo Inventario</a>

    <!-- Formulario de búsqueda -->
    <form action="{{ route('inventarios.index') }}" method="GET" class="mb-4">
        <input type="text" name="query" placeholder="Buscar inventario..." value="{{ request('query') }}" class="border p-2 rounded-md">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Buscar</button>
    </form>
    
    <div class="overflow-x-auto bg-pantone467 shadow-md rounded-lg">
        <table class="min-w-full table-auto w-full">
            <thead class="bg-pantoneWarmGrey1 text-pantoneBlack6">
                <tr>
                    <th class="py-2 px-5 text-left">Serie</th>
                    <th class="py-2 px-5 text-left">Activo</th>
                    <th class="py-2 px-5 text-left">Resguardatario</th>
                    <th class="py-2 px-5 text-left">Estatus</th>
                    <th class="py-2 px-5 text-left">Estado</th>
                    <th class="py-2 px-5 text-left">Modelo</th>
                    <th class="py-2 px-5 text-left">Departamento</th>
                    <th class="py-2 px-5 text-left">Juzgado</th>
                    <th class="py-2 px-5 text-left">Ubicación</th>
                    <th class="py-2 px-5 text-left">Fecha Registro</th>
                    <th class="py-2 px-5 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventarios as $item)
                <tr class="border-b hover:bg-pantone7504">
                    <td class="py-4 px-1">{{ $item->serie }}</td>
                    <td class="py-4 px-1">{{ $item->activo_especifico }}</td>
                    <td class="py-4 px-1">{{ $item->resguardatario }}</td>
                    <td class="py-4 px-1">{{ $item->estatus }}</td>
                    <td class="py-4 px-1">{{ $item->estado }}</td>
                    <td class="py-4 px-1">{{ $item->modelo }}</td>
                    <td class="py-4 px-1">{{ $item->departamento }}</td>
                    <td class="py-4 px-1">{{ $item->juzgado }}</td>
                    <td class="py-4 px-1">{{ $item->ubicacion }}</td>
                    <td class="py-4 px-1">{{ $item->fecha_registro }}</td>
                    <td class="py-3 px-3 flex flex-col gap-1.5">
                        <!-- Botón Ver -->
                        <a href="{{ route('inventarios.show', $item->id) }}" class="bg-pantoneWarmGrey1 text-white py-1.5 px-2 rounded-md hover:bg-pantoneWarmGrey1 text-center">
                            <i class="fas fa-eye"></i> Ver
                        </a>

                        <!-- Botón Editar -->
                        <a href="{{ route('inventarios.edit', $item->id) }}" class="bg-pantone7504 text-white py-1.5 px-2 rounded-md hover:bg-pantone467 text-center">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('inventarios.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este inventario?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-pantone504 text-white py-1.5 px-5 rounded-md hover:bg-red-800 text-center">
                                <i class="fas fa-trash"></i> Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
