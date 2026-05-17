<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validación estricta en servidor de campos obligatorios
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intento de autenticación nativa de Laravel
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            /**
             * NOTA PARA DIEGO:
             * El modelo 'User' debe incluir un atributo o columna 'rol' (e.g., 'asistente', 'organizador')
             * para poder realizar la redirección semántica según los privilegios del usuario.
             */
            $user = Auth::user();
            if ($user->rol === 'organizador') {
                return redirect()->intended('/panel-organizador');
            }

            return redirect()->intended('/perfil');
        }

        // Retorno en caso de credenciales erróneas
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('agenda');
    }
}