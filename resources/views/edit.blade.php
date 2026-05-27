@extends('layouts.app')

@section('contenido')
<main class="container">
    <h2>Ajustes del Perfil</h2>
    <p><a href="{{ route('perfil.asistente') }}">&larr; Volver a mi área personal</a></p>

    @include('alertas')

    <div class="perfil-seccion">
        <h3>Actualizar Información del Perfil</h3>
        <p>Actualiza la información de tu cuenta y la dirección de correo electrónico.</p>

        <form method="POST" action="{{ route('perfil.update') }}">
            @csrf
            @method('patch')

            <div class="campo-formulario">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            </div>

            <div class="campo-formulario">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <button type="submit" class="btn-enviar">Guardar Cambios</button>
        </form>
    </div>

    <hr>

    <div class="perfil-seccion">
        <h3>Actualizar Contraseña</h3>
        <p>Asegúrate de que tu cuenta usa una contraseña larga y aleatoria para mantener la seguridad.</p>

        <form method="POST" action="{{ route('perfil.password') }}">
            @csrf
            @method('put')

            <div class="campo-formulario">
                <label for="current_password">Contraseña Actual:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div class="campo-formulario">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="campo-formulario">
                <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-enviar">Actualizar Contraseña</button>
        </form>
    </div>

    <hr>

    <div class="perfil-seccion seccion-peligro">
        <h3 style="color: #e74c3c;">Borrar Cuenta</h3>
        <p>Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán borrados permanentemente.</p>

        <form method="POST" action="{{ route('perfil.destroy') }}" onsubmit="return confirm('¿Estás absolutamente seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.');">
            @csrf
            @method('delete')

            <div class="campo-formulario">
                <label for="password_delete">Contraseña Actual para Confirmar:</label>
                <input type="password" id="password_delete" name="password" required placeholder="Introduce tu contraseña">
            </div>

            <button type="submit" class="btn-cancelar">Eliminar Cuenta Permanentemente</button>
        </form>
    </div>
</main>
@endsection