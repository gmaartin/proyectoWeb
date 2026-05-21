<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Taller;
use Illuminate\Http\Request;

class TallerController extends Controller
{
    /**
     * Muestra la agenda global de talleres en la página de inicio.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        // 1. Preparamos la consulta base (con el conteo para las plazas libres)
        $query = Taller::withCount('inscripciones');

        // 2. Si el usuario ha usado el buscador lateral, aplicamos el filtro
        if ($request->has('buscar') && $request->buscar != '') {
            $termino = $request->buscar;
            $query->where('titulo', 'LIKE', '%' . $termino . '%')
                ->orWhere('ponente', 'LIKE', '%' . $termino . '%');
        }

        // 3. Ejecutamos la consulta ordenando por fecha
        $talleres = $query->orderBy('fecha', 'asc')
                        ->orderBy('hora_inicio', 'asc')
                        ->get();

        return view('index', compact('talleres'));
    }

    /**
     * Muestra los detalles de un taller específico.
     */
    public function show($id)
    {
        // Buscamos el taller y cargamos también sus materiales asociados
        $taller = Taller::with('materiales')->findOrFail($id);

        // Retornamos la vista de detalle pasando el objeto del taller
        return view('detalle_taller', compact('taller'));
    }

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