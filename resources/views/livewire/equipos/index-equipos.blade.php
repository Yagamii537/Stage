<div>
    @section('page-title', 'Equipos')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Equipos</h2>
        <a href="{{ route('equipos.create') }}" class="btn btn-primary">
            + Nuevo Equipo
        </a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-3">
        <input type="text"
               wire:model.debounce.500ms="search"
               class="form-control"
               placeholder="Buscar por nombre o tipo...">
    </div>

    <table class="table table-dark table-hover align-middle">
        <thead class="table-light text-dark">
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Disp / Total</th>
                <th>Estado</th>
                <th style="width: 140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($equipos as $equipo)
            <tr>
                <td>{{ $equipo->id }}</td>

                <td>
                    @if ($equipo->foto)
                        <img src="{{ asset('storage/'.$equipo->foto) }}"
                             alt="Foto equipo"
                             style="width:40px; height:40px; border-radius:4px; object-fit:cover;">
                    @else
                        <span class="text-muted small">Sin foto</span>
                    @endif
                </td>

                <td>{{ $equipo->nombre }}</td>
                <td>{{ $equipo->tipo }}</td>
                <td>{{ $equipo->marca }}</td>
                <td>{{ $equipo->cantidad_disponible }} / {{ $equipo->cantidad_total }}</td>
                <td>
                    <span class="badge bg-{{
                        $equipo->estado === 'disponible' ? 'success' :
                        ($equipo->estado === 'en_evento' ? 'warning' :
                        ($equipo->estado === 'mantenimiento' ? 'info' : 'danger'))
                    }}">
                        {{ ucfirst($equipo->estado) }}
                    </span>
                </td>
                <td class="text-center">
                    @if ($equipo->qr_code)
                        <a href="{{ asset('storage/'.$equipo->qr_code) }}"
                           target="_blank"
                           class="btn btn-sm btn-outline-light me-1"
                           title="Ver QR">
                            <i class="bi bi-qr-code"></i>
                        </a>
                    @endif

                    <a href="{{ route('equipos.edit', $equipo) }}"
                       class="btn btn-sm btn-outline-light me-1"
                       title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    <button class="btn btn-sm btn-outline-danger"
                            wire:click="eliminar({{ $equipo->id }})"
                            title="Eliminar">
                        <i class="bi bi-trash3"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    No hay equipos registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $equipos->links() }}
</div>
