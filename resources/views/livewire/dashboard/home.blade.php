<div>
    @section('page-title', 'Dashboard')

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stage-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Total de equipos</div>
                        <div class="stage-stat">{{ $totalEquipos }}</div>
                    </div>
                    <span class="badge badge-soft">🎚️</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stage-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">Disponibles</div>
                        <div class="stage-stat text-success">{{ $equiposDisponibles }}</div>
                    </div>
                    <span class="badge badge-soft">✅</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stage-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">En evento</div>
                        <div class="stage-stat text-warning">{{ $equiposEnEvento }}</div>
                    </div>
                    <span class="badge badge-soft">🎤</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stage-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small">En mantenimiento</div>
                        <div class="stage-stat text-info">{{ $equiposMantenimiento }}</div>
                    </div>
                    <span class="badge badge-soft">🛠️</span>
                </div>
            </div>
        </div>
    </div>

    <div class="stage-card">
        <h5 class="mb-3">Resumen rápido</h5>
        <p class="mb-1 small text-muted">
            Aquí luego podemos poner:
        </p>
        <ul class="small mb-0">
            <li>Próximos eventos y fechas de salida/retorno.</li>
            <li>Equipos con más uso o más problemas.</li>
            <li>Alertas de stock bajo, etc.</li>
        </ul>
    </div>
</div>
