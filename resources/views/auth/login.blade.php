@extends('layouts.app')

@section('contenido')
<main>
    <section class="contenedor-login">
        <h2>Acceso a la Plataforma</h2>
        
        @include('alertas')

        <form method="POST" action="{{ route('login') }}" class="formulario-admin">
            @csrf

            <div class="campo-formulario">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="ejemplo@correo.ugr.es" required>
            </div>

            <div class="campo-formulario">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="zona-acciones">

                <button type="submit" class="btn_principal">Iniciar Sesión</button>

                <div class="texto-alternativo">
                    ¿No tienes cuenta aún? <a href="{{ route('register') }}">Registrate aquí</a>
                </div>

            </div>
        </form>
    </section>
</main>
@endsection
