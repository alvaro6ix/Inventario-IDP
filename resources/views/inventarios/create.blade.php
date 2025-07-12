@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl text-pantoneWarmGrey1 font-semibold mb-6">Crear Inventario</h1>

    <form action="{{ route('inventarios.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Fecha de Registro -->
            <div>
                <label for="fecha_registro" class="block text-sm font-medium text-white">Fecha de Registro</label>
                <input type="date" class="mt-1 p-2 w-full border rounded-md" id="fecha_registro" name="fecha_registro" required>
            </div>

            <!-- Serie -->
            <div>
                <label for="serie" class="block text-sm font-medium text-white">Serie</label>
                <input type="text" class="mt-1 p-2 w-full border rounded-md" id="serie" name="serie" required>
            </div>

            <!-- Activo Específico -->
            <div>
                <label for="activo_especifico" class="block text-sm font-medium text-white">Activo Específico</label>
                <select id="activo_especifico" name="activo_especifico" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    <option value="Escritorio">Escritorio</option>
                    <option value="PC">PC</option>
                    <option value="Mouse">Mouse</option>
                    <option value="Silla">Silla</option>
                    <option value="Impresora">Impresora</option>
                    <option value="Teclado">Teclado</option>
                    <option value="Proyector">Proyector</option>
                    <option value="Teléfono">Teléfono</option>
                    <option value="Gabinete">Gabinete</option>
                    <option value="Monitor">Monitor</option>
                </select>
            </div>

            <!-- Resguardatario -->
            <div>
                <label for="resguardatario" class="block text-sm font-medium text-white">Resguardatario</label>
                <input type="text" class="mt-1 p-2 w-full border rounded-md" id="resguardatario" name="resguardatario" required>
            </div>

            <!-- Estatus -->
            <div>
                <label for="estatus" class="block text-sm font-medium text-white">Estatus</label>
                <select id="estatus" name="estatus" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Usado">Usado</option>
                    <option value="Dañado">Dañado</option>
                </select>
            </div>

            <!-- Estado -->
            <div>
                <label for="estado" class="block text-sm font-medium text-white">Estado</label>
                <select id="estado" name="estado" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    <option value="Activo">Activo</option>
                    <option value="Desactivado">Desactivado</option>
                </select>
            </div>

            <!-- Modelo -->
            <div>
                <label for="modelo" class="block text-sm font-medium text-white">Modelo</label>
                <select id="modelo" name="modelo" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    <option value="HP">HP</option>
                    <option value="Dell">Dell</option>
                    <option value="Lenovo">Lenovo</option>
                    <option value="Asus">Asus</option>
                    <option value="Apple">Apple</option>
                    <option value="Acer">Acer</option>
                </select>
            </div>

            <!-- Departamento -->
            <div>
                <label for="departamento" class="block text-sm font-medium text-white">Departamento</label>
                <select id="departamento" name="departamento" class="mt-1 p-2 w-full border rounded-md" required>
                    <option value="">Seleccionar</option>
                    <option value="Sistemas">Sistemas</option>
                    <option value="Administración">Administración</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Finanzas">Finanzas</option>
                    <option value="Logística">Logística</option>
                </select>
            </div>

            <!-- Juzgado -->
            <div>
                <label for="juzgado" class="block text-sm font-medium text-white">Juzgado</label>
                <input type="text" class="mt-1 p-2 w-full border rounded-md" id="juzgado" name="juzgado" required>
            </div>

            <!-- Ubicación -->
            <div>
                <label for="ubicacion" class="block text-sm font-medium text-white">Ubicación</label>
                <input type="text" class="mt-1 p-2 w-full border rounded-md" id="ubicacion" name="ubicacion" required>
            </div>
        </div>

        <!-- Botón para guardar el inventario -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-pantone7504 text-white p-2 rounded-md hover:bg-pantone467">
                Guardar Inventario
            </button>
        </div>
    </form>
</div>
@endsection
