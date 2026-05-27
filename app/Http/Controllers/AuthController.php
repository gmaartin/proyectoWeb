<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']); // Encriptar contraseña
        $validatedData['rol'] = 'asistente'; // Asignar rol por defecto

        // Creación del nuevo usuario
        $user = User::create($validatedData);

        // Autenticación automática después del registro
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/perfil')->with('success', '¡Cuenta creada con éxito! Ya puedes inscribirte a los talleres.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('agenda');
    }
}