@extends('layouts.app')

@section('contenido')
<div class="container">
    <h1>Editar taller</h1>

    <p><a href="{{ route('organizador.panel') }}" class="enlace-volver">Volver al panel</a></p>

    @if ($errors->any())
        <div class="alerta-error">
            <strong>Hay errores en el formulario:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('organizador.talleres.update', $taller) }}" class="formulario-admin">
        @csrf
        @method('PUT')

        <label>Evento:</label>
        <select name="evento_id" required>
            @foreach($eventos as $evento)
                <option value="{{ $evento->id }}" @selected($taller->evento_id == $evento->id)>
                    {{ $evento->titulo }}
                </option>
            @endforeach
        </select>

        <label>Título:</label>
        <input type="text" name="titulo" value="{{ old('titulo', $taller->titulo) }}" required>

        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ old('descripcion', $taller->descripcion) }}</textarea>

        <label>Ponente:</label>
        <input type="text" name="ponente" value="{{ old('ponente', $taller->ponente) }}" required>

        <label>Fecha:</label>
        <input type="date" name="fecha" value="{{ old('fecha', $taller->fecha) }}" required>

        <label>Hora inicio:</label>
        <input type="time" name="hora_inicio" value="{{ old('hora_inicio', $taller->hora_inicio) }}" required>

        <label>Hora fin:</label>
        <input type="time" name="hora_fin" value="{{ old('hora_fin', $taller->hora_fin) }}" required>

        <label>Aula:</label>
        <input type="text" name="aula" value="{{ old('aula', $taller->aula) }}" required>

        <label>Aforo:</label>
        <input type="number" name="aforo" min="1" value="{{ old('aforo', $taller->aforo) }}" required>

        <button type="submit" class="btn_principal">Guardar cambios</button>
    </form>
</div>
@endsection