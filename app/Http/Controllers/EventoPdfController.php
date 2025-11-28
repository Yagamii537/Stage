<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Barryvdh\DomPDF\Facade\Pdf;

class EventoPdfController extends Controller
{
    public function show(Evento $evento)
    {
        // Cargar responsable y equipos con pivot
        $evento->load(['responsable', 'equipos']);

        $pdf = Pdf::loadView('pdf.evento', [
            'evento' => $evento,
        ])->setPaper('A4', 'portrait');

        $filename = 'evento-' . $evento->id . '.pdf';

        // Puedes usar ->download($filename) si quieres descargar directamente
        return $pdf->stream($filename);
    }
}
