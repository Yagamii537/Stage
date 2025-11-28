<div>
    @section('page-title', 'Responsables')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Responsables</h2>
        <a href="{{ route('responsables.create') }}" class="btn btn-primary">+ Nuevo Responsable</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="mb-3">
        <input type="text" wire:model.debounce.500ms="search"
               class="form-control" placeholder="Buscar por nombre...">
    </div>

    <table class="table table-dark table-hover align-middle">
        <thead class="table-light text-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Rol</th>
                <th style="width:120px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($responsables as $resp)
            <tr>
                <td>{{ $resp->id }}</td>
                <td>{{ $resp->nombre }}</td>
                <td>{{ $resp->telefono }}</td>
                <td>{{ $resp->email }}</td>
                <td>{{ $resp->rol }}</td>
                <td class="text-center">
                    <a href="{{ route('responsables.edit', $resp) }}"
                       class="btn btn-sm btn-outline-light me-1" title="Editar">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <button class="btn btn-sm btn-outline-danger"
                            wire:click="eliminar({{ $resp->id }})" title="Eliminar">
                        <i class="bi bi-trash3"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    No hay responsables registrados.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $responsables->links() }}
</div>
