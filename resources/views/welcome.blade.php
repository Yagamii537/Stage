<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>STAGE - Gestión de Material Audiovisual</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">STAGE</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('equipos.index') }}" class="nav-link">Equipos</a>
                </li>
                {{-- Aquí luego agregas: Eventos, Reportes, etc. --}}
            </ul>
        </div>
    </div>
</nav>

<div class="container mb-4">
    {{ $slot ?? '' }}
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
