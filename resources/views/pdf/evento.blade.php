<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evento {{ $evento->nombre }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
        }

        .subtitle {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            font-weight: bold;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th, td {
            border: 1px solid #444;
            padding: 4px 6px;
        }

        th {
            background: #eee;
            font-size: 10px;
            text-align: left;
        }

        td {
            font-size: 10px;
        }

        .small {
            font-size: 9px;
        }

        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 12px; }
    </style>
</head>
<body>

<div class="header">
    <div style="display:flex; align-items:center; gap:12px;">
        <img src="{{ public_path('img/logo.png') }}"
             style="height:55px; width:auto;">
        <div>
            <div class="logo-text" style="font-size:18px; font-weight:bold;">
                Stage
            </div>
            <div class="subtitle" style="font-size:10px; text-transform:uppercase;">
                Producción Técnica E.C.
            </div>
        </div>
    </div>

    <div class="small">
        Fecha impresión: {{ now()->format('d/m/Y H:i') }}<br>
        Evento #{{ $evento->id }}
    </div>
</div>


{{-- Datos principales del evento --}}
<div class="section-title">Datos del evento</div>
<table>
    <tr>
        <th>Nombre</th>
        <td>{{ $evento->nombre }}</td>
    </tr>
    <tr>
        <th>Fecha</th>
        <td>{{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <th>Horario</th>
        <td>
            {{ $evento->hora_inicio ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '--' }}
            -
            {{ $evento->hora_fin ? \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') : '--' }}
        </td>
    </tr>
    <tr>
        <th>Lugar</th>
        <td>{{ $evento->lugar ?? '-' }}</td>
    </tr>
    <tr>
        <th>Cliente</th>
        <td>{{ $evento->cliente ?? '-' }}</td>
    </tr>
    <tr>
        <th>Estado</th>
        <td>{{ ucfirst(str_replace('_', ' ', $evento->estado)) }}</td>
    </tr>
</table>

{{-- Responsable --}}
<div class="section-title mt-2">Responsable</div>
<table>
    <tr>
        <th>Nombre</th>
        <td>{{ $evento->responsable->nombre ?? '-' }}</td>
    </tr>
    <tr>
        <th>Teléfono</th>
        <td>{{ $evento->responsable->telefono ?? '-' }}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $evento->responsable->email ?? '-' }}</td>
    </tr>
    <tr>
        <th>Rol</th>
        <td>{{ $evento->responsable->rol ?? '-' }}</td>
    </tr>
</table>

{{-- Equipos asignados --}}
<div class="section-title mt-3">Equipos en salida</div>

<table>
    <thead>
    <tr>
        <th style="width: 8%;">ID</th>
        <th style="width: 32%;">Equipo</th>
        <th style="width: 20%;">Tipo / Marca</th>
        <th style="width: 10%;">Cant. salida</th>
        <th style="width: 30%;">Observaciones</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($evento->equipos as $equipo)
        <tr>
            <td>{{ $equipo->id }}</td>
            <td>{{ $equipo->nombre }}</td>
            <td>{{ $equipo->tipo }} {{ $equipo->marca ? ' / '.$equipo->marca : '' }}</td>
            <td>{{ $equipo->pivot->cantidad_salida }}</td>
            <td>{{ $equipo->pivot->observaciones ?? '' }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" style="text-align:center;">No hay equipos asignados.</td>
        </tr>
    @endforelse
    </tbody>
</table>

@if ($evento->notas)
    <div class="section-title mt-3">Notas del evento</div>
    <div class="small">
        {!! nl2br(e($evento->notas)) !!}
    </div>
@endif

</body>
</html>
