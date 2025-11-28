<div class="stage-card">
    @section('page-title', $responsable_id ? 'Editar responsable' : 'Nuevo responsable')

    <form wire:submit.prevent="guardar" class="p-3">
        <div class="mb-3">
            <label class="form-label">Nombre *</label>
            <input type="text" wire:model="nombre" class="form-control">
            @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Teléfono</label>
                <input type="text" wire:model="telefono" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Email</label>
                <input type="email" wire:model="email" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Rol</label>
                <input type="text" wire:model="rol" class="form-control" placeholder="Técnico, Stage manager...">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea wire:model="notas" class="form-control" rows="3"></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('responsables.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
