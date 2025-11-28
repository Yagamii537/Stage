<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>STAGE - Producción técnica Ec.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    @livewireStyles
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #111;
            color: #fff;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .stage-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .stage-sidebar {
            width: 250px;
            background: #000;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .stage-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #222;
        }

        .stage-brand h1 {
            font-size: 1.8rem;
            margin: 0;
            font-weight: 700;
        }

        .stage-brand small {
            font-size: .8rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            opacity: .7;
        }

        .stage-menu {
            flex: 1;
            padding: 1rem 0;
        }

        .stage-menu a {
            display: block;
            padding: .7rem 1.25rem;
            color: #ddd;
            text-decoration: none;
            font-size: .95rem;
        }

        .stage-menu a:hover {
            background: #191919;
            color: #fff;
        }

        .stage-menu a.active {
            background: #fff;
            color: #000;
            font-weight: 600;
        }

        .stage-footer {
            padding: .75rem 1rem;
            font-size: .75rem;
            border-top: 1px solid #222;
            opacity: .7;
        }

        .stage-content {
            flex: 1;
            background: #151515;
            padding: 1rem 1.5rem 2rem;
        }

        .stage-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stage-topbar h2 {
            margin: 0;
            font-size: 1.4rem;
        }

        .stage-card {
            background: #1e1e1e;
            border-radius: .75rem;
            padding: 1rem 1.25rem;
            border: 1px solid #262626;
        }

        .stage-stat {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .badge-soft {
            background: #fff;
            color: #000;
        }

        @media (max-width: 768px) {
            .stage-wrapper {
                flex-direction: column;
            }
            .stage-sidebar {
                width: 100%;
                flex-direction: row;
                align-items: center;
            }
            .stage-menu {
                display: flex;
                flex-direction: row;
                overflow-x: auto;
            }
            .stage-menu a {
                padding: .7rem 1rem;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

<div class="stage-wrapper">
    {{-- SIDEBAR --}}
    <aside class="stage-sidebar">
        <div class="stage-brand d-flex align-items-center gap-2">
            <img src="{{ asset('img/logo.png') }}"
                alt="Stage"
                width="180er; object-fit:contain;">

        </div>

        <nav class="stage-menu">
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('equipos.index') }}"
               class="{{ request()->routeIs('equipos.*') ? 'active' : '' }}">
                🎛️ Equipos
            </a>
            {{-- Aquí luego Eventos, Reportes, etc. --}}
        </nav>

        <div class="stage-footer">
            &copy; {{ date('Y') }} Stage · Producción técnica Ec.
        </div>
    </aside>

    {{-- CONTENIDO --}}
    <main class="stage-content">
        <div class="stage-topbar">
            <h2>@yield('page-title', 'Panel')</h2>

            {{-- área para usuario / logout si usas auth --}}
            @auth
                <span class="small">Hola, {{ auth()->user()->name ?? 'Usuario' }}</span>
            @endauth
        </div>

        {{-- contenido Livewire (slot) --}}
        {{ $slot ?? '' }}
    </main>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
