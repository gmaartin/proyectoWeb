@extends('layouts.app')

@section('contenido')
<main>
    <section class="contenedor-login">
        <h2>Registro en la Plataforma</h2>

        @include('alertas')

        <form action="{{ route('register') }}" method="POST" class="formulario-admin">
            @csrf
            
            <div class="campo-formulario">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre completo" required>
            </div>
            
            <div class="campo-formulario">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.ugr.es" required>
            </div>

            <div class="campo-formulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="campo-formulario">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="zona-acciones">
                <button type="submit" class="btn_principal">Registrarse</button>
    
                <div class="texto-alternativo">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                </div>
            </div>
        </form>
    </section>
</main>
@endsection