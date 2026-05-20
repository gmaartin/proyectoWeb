<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    /**
     * Muestra el área privada del asistente con sus talleres inscritos.
     */
    public function perfil()
    {
        $user = Auth::user();
        
        // Obtenemos las inscripciones del usuario actual cruzando los datos con la tabla talleres
        $inscripciones = Inscripcion::with('taller')->where('user_id', $user->id)->get();

        return view('perfil_asistente', compact('inscripciones', 'user'));
    }

    /**
     * Procesa la solicitud de inscripción aplicando las validaciones de negocio.
     */
    public function inscribir(Request $request, $id)
    {
        $user = Auth::user();
        
        // Buscamos el taller en la base de datos
        $taller = Taller::findOrFail($id);

        // 1. COMPROBACIÓN DE DUPLICIDAD: ¿El usuario ya está inscrito?
        $yaInscrito = Inscripcion::where('user_id', $user->id)
                                ->where('taller_id', $taller->id)
                                ->exists();

        if ($yaInscrito) {
            return back()->withErrors([
                'duplicado' => "Ya tienes una plaza reservada para el taller '{$taller->titulo}'."
            ]);
        }

        // 2. COMPROBACIÓN DE AFORO: ¿El taller está lleno?
        $ocupacionActual = Inscripcion::where('taller_id', $taller->id)->count();

        if ($ocupacionActual >= $taller->aforo) {
            return back()->withErrors([
                'cupo_lleno' => "Operación denegada: El taller '{$taller->titulo}' ha alcanzado el límite máximo de {$taller->aforo} plazas disponibles."
            ]);
        }

        // 3. INSERCIÓN: Si pasa las comprobaciones, creamos el registro de inscripción
        // Usamos la misma estructura que Diego preparó en su Seeder
        Inscripcion::create([
            'user_id' => $user->id,
            'taller_id' => $taller->id,
            'asistio' => false, // Valor por defecto
        ]);

        // Redirigimos al perfil del usuario con un mensaje de éxito
        return redirect()->route('perfil.asistente')->with('success', '¡Inscripción procesada correctamente!');
    }

    /**
     * Cancela una inscripción y libera la plaza.
     */
    public function cancelar($id)
    {
        $user = Auth::user();
        
        // Buscamos la inscripción asegurándonos de que es del usuario actual
        $inscripcion = Inscripcion::where('id', $id)
                                ->where('user_id', $user->id)
                                ->firstOrFail();

        // Eliminamos el registro de la base de datos
        $inscripcion->delete();

        return redirect()->route('perfil.asistente')->with('success', 'Tu inscripción ha sido cancelada y la plaza ha sido liberada.');
    }
}
