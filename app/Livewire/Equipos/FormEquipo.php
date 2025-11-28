<?php

namespace App\Livewire\Equipos;

use App\Models\Equipo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

#[Layout('layouts.stage')]
class FormEquipo extends Component
{
    use WithFileUploads;

    public ?int $equipo_id = null;

    public string $nombre = '';
    public string $tipo = '';
    public ?string $marca = null;
    public ?string $modelo = null;
    public ?string $num_serie = null;
    public string $estado = 'disponible';
    public int $cantidad_total = 0;
    public int $cantidad_disponible = 0;
    public ?string $descripcion = null;

    // imagen
    public $foto;                // archivo nuevo que se sube
    public ?string $foto_actual = null;  // ruta ya guardada

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'tipo' => 'required|string|max:255',
        'marca' => 'nullable|string|max:255',
        'modelo' => 'nullable|string|max:255',
        'num_serie' => 'nullable|string|max:255',
        'estado' => 'required|in:disponible,en_evento,mantenimiento,perdido',
        'cantidad_total' => 'required|integer|min:0',
        'cantidad_disponible' => 'required|integer|min:0',
        'descripcion' => 'nullable|string',
        'foto' => 'nullable|image|max:2048', // 2MB
    ];

    public function mount(Equipo $equipo = null): void
    {
        if ($equipo && $equipo->exists) {
            $this->equipo_id = $equipo->id;
            $this->nombre = $equipo->nombre;
            $this->tipo = $equipo->tipo;
            $this->marca = $equipo->marca;
            $this->modelo = $equipo->modelo;
            $this->num_serie = $equipo->num_serie;
            $this->estado = $equipo->estado;
            $this->cantidad_total = $equipo->cantidad_total;
            $this->cantidad_disponible = $equipo->cantidad_disponible;
            $this->descripcion = $equipo->descripcion;
            $this->foto_actual = $equipo->foto;
        }
    }

    public function guardar()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'tipo' => $this->tipo,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'num_serie' => $this->num_serie,
            'estado' => $this->estado,
            'cantidad_total' => $this->cantidad_total,
            'cantidad_disponible' => $this->cantidad_disponible,
            'descripcion' => $this->descripcion,
        ];

        // si se sube nueva foto, la guardamos
        if ($this->foto) {
            $ruta = $this->foto->store('equipos', 'public'); // storage/app/public/equipos/...
            $data['foto'] = $ruta;
        }

        if ($this->equipo_id) {
            $equipo = Equipo::findOrFail($this->equipo_id);
            $equipo->update($data);
            session()->flash('message', 'Equipo actualizado correctamente.');
        } else {
            $equipo = Equipo::create($data);
            $this->equipo_id = $equipo->id;
            session()->flash('message', 'Equipo creado correctamente.');
        }

        // Generar / actualizar QR
        $qrPath = 'qrs/equipo-' . $equipo->id . '.svg';

        $svg = QrCode::size(300)
            ->encoding('UTF-8')
            ->generate('EQUIPO-' . $equipo->id);

        // Guardar archivo SVG manualmente
        file_put_contents(
            storage_path('app/public/' . $qrPath),
            $svg
        );

        $equipo->qr_code = $qrPath;
        $equipo->save();

        return redirect()->route('equipos.index');
    }

    public function render()
    {
        return view('livewire.equipos.form-equipo');
    }
}
