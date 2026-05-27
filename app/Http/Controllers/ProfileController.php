<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario para editar el perfil.
     */
    public function edit()
    {
        return view('edit', ['user' => Auth::user()]);
    }

    /**
     * Actualiza la información básica del perfil (nombre y email).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validamos los datos.
        // ignorando el ID del usuario actual para que pueda guardar su propio correo sin error.
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->fill($validatedData);
        $user->save();

        return redirect()->route('perfil.asistente')->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Actualiza la contraseña del usuario.
     */
    public function updatePassword(Request $request)
    {
        // Validamos la contraseña actual, la nueva y su confirmación
        $validatedData = $request->validate([
            'current_password' => ['required', 'current_password'], // 'current_password' verifica que coincida con la BD
            'password' => ['required', Password::defaults(), 'confirmed'], // Exige confirmación (password_confirmation)
        ]);

        $request->user()->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }

    /**
     * Elimina la cuenta del usuario.
     */
    public function destroy(Request $request)
    {
        // Por seguridad, exigimos la contraseña actual para borrar la cuenta
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();

        // Cerramos sesión
        Auth::logout();

        // Borramos el usuario (las inscripciones deberían borrarse en cascada)
        $user->delete();

        // Invalidamos la sesión actual
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Tu cuenta ha sido eliminada permanentemente.');
    }
}