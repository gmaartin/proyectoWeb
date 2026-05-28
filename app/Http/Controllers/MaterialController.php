<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Taller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    private function comprobarOrganizador()
    {
        if (!auth()->check() || auth()->user()->rol !== 'organizador') {
            abort(403, 'No tienes permiso para acceder al área del organizador.');
        }
    }

    public function index()
    {
        $this->comprobarOrganizador();

        $talleres = Taller::orderBy('fecha')
            ->orderBy('hora_inicio')
            ->get();

        $materiales = Material::with('taller')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('organizador.materiales', compact('talleres', 'materiales'));
    }

    public function store(Request $request)
    {
        $this->comprobarOrganizador();

        $datos = $request->validate([
            'taller_id' => 'required|exists:talleres,id',
            'titulo' => 'required|string|max:255',
            'archivo' => 'required|file|max:10240|mimes:pdf,doc,docx,ppt,pptx,zip,txt',
        ]);

        $rutaArchivo = $request->file('archivo')->store('materiales', 'public');

        Material::create([
            'taller_id' => $datos['taller_id'],
            'titulo' => $datos['titulo'],
            'archivo' => $rutaArchivo,
        ]);

        return redirect()
            ->route('organizador.materiales')
            ->with('success', 'Material subido correctamente.');
    }

    public function destroy(\App\Models\Material $material)
    {
        // Eliminamos el registro
        $material->delete();

        // Redirigimos a la misma página con un mensaje de éxito
        return back()->with('success', 'El material ha sido eliminado correctamente del inventario.');
    }
}