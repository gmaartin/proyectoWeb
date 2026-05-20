<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
/**
 * NOTA PARA DIEGO:
 * Se asume la existencia de los modelos 'Taller' y 'User' mapeados mediante Eloquent, 
 * así como una tabla pivote 'inscripciones' gestionada por relaciones N:M.
 */
// use App\Models\Taller;

class InscripcionController extends Controller
{
    public function perfil()
    {
        $user = Auth::user();
        
        /**
         * NOTA PARA DIEGO:
         * En el modelo 'User' se debe definir la relación muchos a muchos:
         * public function talleres() { return $this->belongsToMany(Taller::class, 'inscripciones'); }
         */
        $misTalleres = []; // Temporal hasta BD: $user->talleres;

        return view('perfil_asistente', compact('misTalleres'));
    }

    public function inscribir(Request $request, $id)
    {
        $user = Auth::user();
        
        /**
         * LOGICA DE NEGOCIO SIMULADA:
         * Simulamos la extracción del taller desde la base de datos (Operación de Diego).
         * Reemplazar por: $taller = Taller::findOrFail($id);
         */
        $taller = new \stdClass();
        $taller->id = $id;
        $taller->titulo = "Taller Tecnológico de Prueba";
        $taller->aforo_maximo = 30; // Cupo límite estipulado

        // 1. Cálculo de ocupación actual (Relación controlada por Diego)
        // Reemplazar por conteo real en BD: $inscritosActuales = $taller->usuarios()->count();
        $inscritosActuales = 30; // FORZADO A MÁXIMO PARA TESTEAR EL BLOQUEO AUTOMÁTICO

        // 2. VALIDACIÓN CLAVE: Bloqueo automático si se alcanza el cupo máximo
        if ($inscritosActuales >= $taller->aforo_maximo) {
            return back()->withErrors([
                'cupo_lleno' => "Operación denegada: El taller '{$taller->titulo}' ha alcanzado el límite máximo de plazas disponibles."
            ]);
        }

        // 3. Comprobación de duplicidad (Evitar que se inscriba dos veces al mismo taller)
        // Reemplazar por: if ($user->talleres()->where('taller_id', $id)->exists()) { ... }

        // 4. Inserción del registro físico en la tabla pivote de inscripciones
        // Reemplazar por: $user->talleres()->attach($id);

        return redirect()->route('perfil.asistente')->with('success', 'Inscripción procesada correctamente.');
    }
}
