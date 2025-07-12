<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IDP</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-pantone504 grid min-h-screen grid-rows-[auto_1fr_auto]">

    <!-- Barra de navegación -->
    <div class="bg-pantone467 text-pantoneBlack6 p-4">
    <nav class="flex justify-center">
            <ul class="flex items-center space-x-8">
                <li class="flex items-center space-x-1">
                <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="w-16 h-16">

                    <a href="{{ route('inventarios.index') }}" class="hover:text-gray-800">Inventario IDP</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Contenido principal -->
    <div class="mx-auto p-0 w-full">
        @yield('content') <!-- Aquí se insertará el contenido de cada vista -->
    </div>

    <!-- Pie de página -->
    <footer class="bg-pantone467 text-white text-center p-4 flex items-center justify-center space-x-2">
    <img src="{{ asset('images/logo-color2.png') }}" alt="Logo" class="w-16 h-16">

        <p>&copy; 2025 Instituto de la Defensoría Pública.</p>
    </footer>

</body>
</html>
