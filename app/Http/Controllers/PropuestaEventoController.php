<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Taller;
use App\Models\PropuestaEvento;
use Illuminate\Http\Request;

class PropuestaEventoController extends Controller
{
    private function comprobarOrganizador()
    {
        if (!auth()->check() || auth()->user()->rol !== 'organizador') {
            abort(403, 'No tienes permiso para acceder al área del organizador.');
        }
    }

    public function create()
    {
        return view('propuestas.crear');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ponente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'aula' => 'required|string|max:255',
            'aforo' => 'required|integer|min:1',
        ]);

        $datos['user_id'] = auth()->id();
        $datos['estado'] = 'pendiente';

        PropuestaEvento::create($datos);

        return redirect()
            ->route('propuestas.crear')
            ->with('success', 'Tu propuesta se ha enviado correctamente. Queda pendiente de revisión por el organizador.');
    }

    public function indexOrganizador()
    {
        $this->comprobarOrganizador();

        $propuestas = PropuestaEvento::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('organizador.propuestas', compact('propuestas'));
    }

    public function aceptar(PropuestaEvento $propuesta)
    {
        $this->comprobarOrganizador();

        $evento = Evento::first();

        Taller::create([
            'evento_id' => $evento->id,
            'titulo' => $propuesta->titulo,
            'descripcion' => $propuesta->descripcion,
            'ponente' => $propuesta->ponente,
            'fecha' => $propuesta->fecha,
            'hora_inicio' => $propuesta->hora_inicio,
            'hora_fin' => $propuesta->hora_fin,
            'aula' => $propuesta->aula,
            'aforo' => $propuesta->aforo,
        ]);

        $propuesta->update([
            'estado' => 'aceptada',
            'comentario_organizador' => 'Propuesta aceptada y añadida a la agenda.',
        ]);

        return redirect()
            ->route('organizador.propuestas')
            ->with('success', 'Propuesta aceptada y añadida a la agenda.');
    }

    public function rechazar(Request $request, PropuestaEvento $propuesta)
    {
        $this->comprobarOrganizador();

        $datos = $request->validate([
            'comentario_organizador' => 'nullable|string|max:1000',
        ]);

        $propuesta->update([
            'estado' => 'rechazada',
            'comentario_organizador' => $datos['comentario_organizador'] ?? 'Propuesta rechazada por el organizador.',
        ]);

        return redirect()
            ->route('organizador.propuestas')
            ->with('success', 'Propuesta rechazada correctamente.');
    }
}