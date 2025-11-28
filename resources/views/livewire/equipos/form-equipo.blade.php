<div class="stage-card">
    @section('page-title', $equipo_id ? 'Editar equipo' : 'Nuevo equipo')

    <div class="card-body p-0">
        <form wire:submit.prevent="guardar" class="p-3">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nombre *</label>
                    <input type="text" wire:model="nombre" class="form-control">
                    @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo *</label>
                    <input type="text" wire:model="tipo" class="form-control" placeholder="Consola, mic, cable, luz...">
                    @error('tipo') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Marca</label>
                    <input type="text" wire:model="marca" class="form-control">
                    @error('marca') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Modelo</label>
                    <input type="text" wire:model="modelo" class="form-control">
                    @error('modelo') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Número de serie</label>
                    <input type="text" wire:model="num_serie" class="form-control">
                    @error('num_serie') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Cantidad total *</label>
                    <input type="number" wire:model="cantidad_total" class="form-control" min="0">
                    @error('cantidad_total') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cantidad disponible *</label>
                    <input type="number" wire:model="cantidad_disponible" class="form-control" min="0">
                    @error('cantidad_disponible') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estado *</label>
                    <select wire:model="estado" class="form-select">
                        <option value="disponible">Disponible</option>
                        <option value="en_evento">En evento</option>
                        <option value="mantenimiento">Mantenimiento</option>
                        <option value="perdido">Perdido</option>
                    </select>
                    @error('estado') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- FOTO --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Foto del equipo</label>
                    <input type="file" wire:model="foto" class="form-control">
                    @error('foto') <span class="text-danger small">{{ $message }}</span> @enderror

                    @if ($foto)
                        <div class="mt-2">
                            <img src="{{ $foto->temporaryUrl() }}" class="img-thumbnail"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                    @elseif ($foto_actual)
                        <div class="mt-2">
                            <img src="{{ asset('storage/'.$foto_actual) }}" class="img-thumbnail"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción / observaciones</label>
                <textarea wire:model="descripcion" class="form-control" rows="3"></textarea>
                @error('descripcion') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('equipos.index') }}" class="btn btn-secondary">
                    Volver
                </a>
                <button type="submit" class="btn btn-success">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>
