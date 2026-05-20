<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class OrganizadorController extends Controller
{
    private function comprobarOrganizador()
    {
        if (!auth()->check() || auth()->user()->rol !== 'organizador') {
            abort(403, 'No tienes permiso para acceder al panel del organizador.');
        }
    }

    public function index()
    {
        $this->comprobarOrganizador();

        $talleres = Taller::withCount('inscripciones')
            ->orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        return view('organizador.panel', compact('talleres'));
    }

    public function inscritos()
    {
        $this->comprobarOrganizador();

        $inscripciones = Inscripcion::with(['user', 'taller'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('organizador.inscritos', compact('inscripciones'));
    }

public function actualizarAsistencia(Request $request, Inscripcion $inscripcion)
{
    $this->comprobarOrganizador();

    $datos = $request->validate([
        'asistio' => 'required|boolean',
    ]);

    $inscripcion->update([
        'asistio' => $datos['asistio'],
    ]);

    return redirect()
        ->route('organizador.inscritos')
        ->with('success', 'Asistencia actualizada correctamente.');
}

}