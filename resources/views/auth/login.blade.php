@extends('layouts.app')

@section('contenido')
<main>
    <section class="contenedor-login">
        <h2>Acceso a la Plataforma</h2>
        
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
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
                <button type="submit" class="btn-enviar">Iniciar Sesión</button>
            </div>
        </form>
    </section>
</main>
@endsection