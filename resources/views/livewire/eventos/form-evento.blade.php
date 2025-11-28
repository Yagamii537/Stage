<div class="stage-card">
    @section('page-title', $evento_id ? 'Editar evento' : 'Nuevo evento')

    <form wire:submit.prevent="guardar" class="p-3">
        <div class="row mb-3">
            <div class="col-md-8">
                <label class="form-label">Nombre del evento *</label>
                <input type="text" wire:model="nombre" class="form-control">
                @error('nombre') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Fecha *</label>
                <input type="date" wire:model="fecha_evento" class="form-control">
                @error('fecha_evento') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Hora inicio</label>
                <input type="time" wire:model="hora_inicio" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Hora fin</label>
                <input type="time" wire:model="hora_fin" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Lugar</label>
                <input type="text" wire:model="lugar" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Cliente</label>
                <input type="text" wire:model="cliente" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Responsable</label>
                <select wire:model="responsable_id" class="form-select">
                    <option value="">-- Seleccione --</option>
                    @foreach ($responsables as $resp)
                        <option value="{{ $resp->id }}">{{ $resp->nombre }}</option>
                    @endforeach
                </select>
                @error('responsable_id') <span class="text-danger small">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Estado</label>
                <select wire:model="estado" class="form-select">
                    <option value="planificado">Planificado</option>
                    <option value="en_curso">En curso</option>
                    <option value="finalizado">Finalizado</option>
                    <option value="cancelado">Cancelado</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Notas</label>
            <textarea wire:model="notas" class="form-control" rows="2"></textarea>
        </div>

        <hr class="border-secondary">

        <h5 class="mb-2">Equipos asignados al evento</h5>
        <p class="small text-muted mb-2">
            Indica la <strong>cantidad de salida</strong> para cada equipo (0 = no se usa).
        </p>

        <div class="table-responsive mb-3">
            <table class="table table-dark table-sm align-middle">
                <thead class="table-light text-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Stock disp.</th>
                    <th>Cant. salida</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->nombre }} <span class="text-muted small">({{ $equipo->tipo }})</span></td>
                        <td>{{ $equipo->cantidad_disponible }}</td>
                        <td style="width:130px;">
                            <input type="number"
                                   min="0"
                                   class="form-control form-control-sm"
                                   wire:model.defer="items.{{ $equipo->id }}">
                            @error('items.'.$equipo->id)
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Volver</a>
            <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </form>
</div>
