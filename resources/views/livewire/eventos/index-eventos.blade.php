<div>
    @section('page-title', 'Eventos')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Eventos</h2>
        <a href="{{ route('eventos.create') }}" class="btn btn-primary">+ Nuevo Evento</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <input type="text" wire:model.debounce.500ms="search"
               class="form-control" placeholder="Buscar por nombre de evento...">
    </div>


    <table class="table table-dark table-hover align-middle">
        <thead class="table-light text-dark">
        <tr>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Lugar</th>
            <th>Cliente</th>
            <th>Responsable</th>
            <th>Estado</th>
            <th style="width:140px;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($eventos as $evento)
            <tr>
                <td>{{ \Carbon\Carbon::parse($evento->fecha_evento)->format('d/m/Y') }}</td>
                <td>{{ $evento->nombre }}</td>
                <td>{{ $evento->lugar }}</td>
                <td>{{ $evento->cliente }}</td>
                <td>{{ $evento->responsable->nombre ?? '-' }}</td>
                <td>
                    <span class="badge bg-{{ $evento->estado === 'planificado' ? 'secondary' :
                                              ($evento->estado === 'en_curso' ? 'info' :
                                              ($evento->estado === 'finalizado' ? 'success' : 'danger')) }}">
                        {{ ucfirst(str_replace('_', ' ', $evento->estado)) }}
                    </span>
                </td>
                <td class="text-center">

                    {{-- PDF --}}
                    <a href="{{ route('eventos.pdf', $evento) }}"
                    target="_blank"
                    class="btn btn-sm btn-outline-light me-1"
                    title="PDF">
                        <i class="bi bi-filetype-pdf"></i>
                    </a>

                    {{-- EDITAR --}}
                    <a href="{{ route('eventos.edit', $evento) }}"
                    class="btn btn-sm btn-outline-light me-1"
                    title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>

                    {{-- ELIMINAR --}}
                    <button class="btn btn-sm btn-outline-danger"
                            wire:click="eliminar({{ $evento->id }})"
                            title="Eliminar">
                        <i class="bi bi-trash3"></i>
                    </button>
                </td>


            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    No hay eventos registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $eventos->links() }}
</div>
