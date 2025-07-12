@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl text-white mb-4">Editar Inventario</h1>

    <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4"> 
            <!-- Fecha de Registro -->
            <div class="mb-1">
                <label for="fecha_registro" class="block text-sm font-medium text-white">Fecha de Registro</label>
                <input type="date" class="mt-1 p-2 block w-full border rounded-md" id="fecha_registro" name="fecha_registro" value="{{ old('fecha_registro', $inventario->fecha_registro) }}" required>
            </div>

            <!-- Serie -->
            <div class="mb-1">
                <label for="serie" class="block text-sm font-medium text-white">Serie</label>
                <input type="text" class="mt-1 p-2 block w-full border rounded-md" id="serie" name="serie" value="{{ old('serie', $inventario->serie) }}" required>
            </div>

            <!-- Activo Específico -->
            <div class="mb-1">
                <label for="activo_especifico" class="block text-sm font-medium text-white">Activo Específico</label>
                <select id="activo_especifico" name="activo_especifico" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Escritorio', 'PC', 'Mouse', 'Silla', 'Impresora', 'Teclado', 'Proyector', 'Teléfono', 'Gabinete', 'Monitor'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('activo_especifico', $inventario->activo_especifico) == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Resguardatario -->
            <div class="mb-1">
                <label for="resguardatario" class="block text-sm font-medium text-white">Resguardatario</label>
                <input type="text" class="mt-1 p-2 block w-full border rounded-md" id="resguardatario" name="resguardatario" value="{{ old('resguardatario', $inventario->resguardatario) }}" required>
            </div>

            <!-- Estatus -->
            <div class="mb-1">
                <label for="estatus" class="block text-sm font-medium text-white">Estatus</label>
                <select id="estatus" name="estatus" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Nuevo', 'Usado', 'Dañado'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('estatus', $inventario->estatus) == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Estado -->
            <div class="mb-1">
                <label for="estado" class="block text-sm font-medium text-white">Estado</label>
                <select id="estado" name="estado" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Activo', 'Desactivado'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('estado', $inventario->estado) == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Modelo -->
            <div class="mb-1">
                <label for="modelo" class="block text-sm font-medium text-white">Modelo</label>
                <select id="modelo" name="modelo" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    @foreach(['HP', 'Dell', 'Lenovo', 'Asus', 'Apple', 'Acer'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('modelo', $inventario->modelo) == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Departamento -->
            <div class="mb-1">
                <label for="departamento" class="block text-sm font-medium text-white">Departamento</label>
                <select id="departamento" name="departamento" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    @foreach(['Sistemas', 'Administración', 'Recursos Humanos', 'Finanzas', 'Logística'] as $opcion)
                        <option value="{{ $opcion }}" {{ old('departamento', $inventario->departamento) == $opcion ? 'selected' : '' }}>{{ $opcion }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Juzgado -->
            <div class="mb-1">
                <label for="juzgado" class="block text-sm font-medium text-white">Juzgado</label>
                <input type="text" class="mt-1 p-2 block w-full border rounded-md" id="juzgado" name="juzgado" value="{{ old('juzgado', $inventario->juzgado) }}" required>
            </div>

            <!-- Ubicación -->
            <div class="mb-1">
                <label for="ubicacion" class="block text-sm font-medium text-white">Ubicación</label>
                <input type="text" class="mt-1 p-2 block w-full border rounded-md" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $inventario->ubicacion) }}" required>
            </div>
        </div>

        <!-- Botón para actualizar -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-pantone7504 text-white p-2 rounded-md hover:bg-pantone467">
                Actualizar Inventario
            </button>
        </div>
    </form>
</div>
@endsection
