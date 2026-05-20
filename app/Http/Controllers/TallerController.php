<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Taller;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    private function comprobarOrganizador()
    {
        if (!auth()->check() || auth()->user()->rol !== 'organizador') {
            abort(403, 'No tienes permiso para acceder al área del organizador.');
        }
    }

    public function create()
    {
        $this->comprobarOrganizador();

        $eventos = Evento::all();

        return view('organizador.crear_taller', compact('eventos'));
    }

    public function store(Request $request)
    {
        $this->comprobarOrganizador();

        $datos = $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ponente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'aula' => 'required|string|max:255',
            'aforo' => 'required|integer|min:1',
        ]);

        Taller::create($datos);

        return redirect()
            ->route('organizador.panel')
            ->with('success', 'Taller creado correctamente.');
    }

    public function edit(Taller $taller)
    {
        $this->comprobarOrganizador();

        $eventos = Evento::all();

        return view('organizador.editar_taller', compact('taller', 'eventos'));
    }

    public function update(Request $request, Taller $taller)
    {
        $this->comprobarOrganizador();

        $datos = $request->validate([
            'evento_id' => 'required|exists:eventos,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ponente' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'aula' => 'required|string|max:255',
            'aforo' => 'required|integer|min:1',
        ]);

        $taller->update($datos);

        return redirect()
            ->route('organizador.panel')
            ->with('success', 'Taller actualizado correctamente.');
    }

    public function destroy(Taller $taller)
    {
        $this->comprobarOrganizador();

        $taller->delete();

        return redirect()
            ->route('organizador.panel')
            ->with('success', 'Taller eliminado correctamente.');
    }
}