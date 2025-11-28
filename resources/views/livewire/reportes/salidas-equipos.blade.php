<div class="container-fluid py-4">

    <h2 class="text-white mb-4">Reporte de salidas de equipos</h2>

    {{-- =====================  FILTROS  ===================== --}}
    <div class="card bg-dark border-light mb-4">
        <div class="card-body text-white">

            <div class="row g-3">

                {{-- Fecha desde --}}
                <div class="col-md-3">
                    <label class="form-label">Fecha desde</label>
                    <input type="date" class="form-control" wire:model.live="fecha_desde">
                </div>

                {{-- Fecha hasta --}}
                <div class="col-md-3">
                    <label class="form-label">Fecha hasta</label>
                    <input type="date" class="form-control" wire:model.live="fecha_hasta">
                </div>

                {{-- Equipo --}}
                <div class="col-md-3">
                    <label class="form-label">Equipo</label>
                    <select class="form-select" wire:model.live="equipo_id">
                        <option value="">-- Todos --</option>
                        @foreach ($equipos as $eq)
                            <option value="{{ $eq->id }}">{{ $eq->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Responsable --}}
                <div class="col-md-3">
                    <label class="form-label">Responsable</label>
                    <select class="form-select" wire:model.live="responsable_id">
                        <option value="">-- Todos --</option>
                        @foreach ($responsables as $r)
                            <option value="{{ $r->id }}">{{ $r->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Estado --}}
                <div class="col-md-3 mt-3">
                    <label class="form-label">Estado del evento</label>
                    <select class="form-select" wire:model.live="estado_evento">
                        <option value="todos">Todos</option>
                        <option value="planificado">Planificado</option>
                        <option value="en_curso">En curso</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>

            </div>
        </div>
    </div>

    {{-- =====================  TABLA RESULTADOS  ===================== --}}
    <div class="card bg-dark border-light">
        <div class="card-body table-responsive">

            <table class="table table-dark table-hover align-middle">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Evento / Lugar</th>
                        <th>Responsable</th>
                        <th>Equipo</th>
                        <th>Cant. salida</th>
                        <th>Cant. retorno</th>
                        <th>Estado retorno</th>
                        <th>Estado evento</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($movimientos as $m)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($m->fecha_evento)->format('d/m/Y') }}</td>

                            <td>
                                <strong>{{ $m->evento_nombre }}</strong><br>
                                <small class="text-secondary">{{ $m->lugar }}</small>
                            </td>

                            <td>{{ $m->responsable_nombre }}</td>
                            <td>{{ $m->equipo_nombre }}</td>

                            <td>{{ $m->cantidad_salida }}</td>
                            <td>{{ $m->cantidad_retorno }}</td>

                            <td>
                                <span class="badge bg-secondary">{{ strtoupper($m->estado_retorno) }}</span>
                            </td>

                            <td>
                                @if ($m->evento_estado === 'planificado')
                                    <span class="badge bg-info">Planificado</span>
                                @elseif ($m->evento_estado === 'en_curso')
                                    <span class="badge bg-primary">En curso</span>
                                @elseif ($m->evento_estado === 'finalizado')
                                    <span class="badge bg-success">Finalizado</span>
                                @elseif ($m->evento_estado === 'cancelado')
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
                                No hay movimientos con los filtros aplicados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
