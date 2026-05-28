@extends('layouts.app')

@section('contenido')
<div class="container">
    <h1>Crear taller</h1>

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

    <form method="POST" action="{{ route('organizador.talleres.store') }}" class="formulario-admin">
        @csrf

        <label>Evento:</label>
        <select name="evento_id" required>
            @foreach($eventos as $evento)
                <option value="{{ $evento->id }}">{{ $evento->titulo }}</option>
            @endforeach
        </select>

      

        <label>Título:</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required>

       

        <label>Descripción:</label>
        <textarea name="descripcion" required>{{ old('descripcion') }}</textarea>

        

        <label>Ponente:</label>
        <input type="text" name="ponente" value="{{ old('ponente') }}" required>

        

        <label>Fecha:</label>
        <input type="date" name="fecha" value="{{ old('fecha') }}" required>

        

        <label>Hora inicio:</label>
        <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" required>

        

        <label>Hora fin:</label>
        <input type="time" name="hora_fin" value="{{ old('hora_fin') }}" required>

        

        <label>Aula:</label>
        <input type="text" name="aula" value="{{ old('aula') }}" required>

        

        <label>Aforo:</label>
        <input type="number" name="aforo" min="1" value="{{ old('aforo') }}" required>

        

        <button type="submit" class="btn_principal">Crear taller</button>
    </form>
</div>
@endsection