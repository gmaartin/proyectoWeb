@extends('layouts.app')

@section('contenido')
<main>
    <section class="ficha_evento">
        <h2 class="titulo_evento">Proponer nuevo evento o taller</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if ($errors->any())
            <div style="color: red;">
                <strong>Hay errores en el formulario:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('propuestas.store') }}" class="formulario-admin">
            @csrf

            <p>
                <label>Título:</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" required>
            </p>

            <p>
                <label>Descripción:</label>
                <textarea name="descripcion" required>{{ old('descripcion') }}</textarea>
            </p>

            <p>
                <label>Ponente:</label>
                <input type="text" name="ponente" value="{{ old('ponente') }}" required>
            </p>

            <p>
                <label>Fecha:</label>
                <input type="date" name="fecha" value="{{ old('fecha') }}" required>
            </p>

            <p>
                <label>Hora inicio:</label>
                <input type="time" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
            </p>

            <p>
                <label>Hora fin:</label>
                <input type="time" name="hora_fin" value="{{ old('hora_fin') }}" required>
            </p>

            <p>
                <label>Aula:</label>
                <input type="text" name="aula" value="{{ old('aula') }}" required>
            </p>

            <p>
                <label>Aforo:</label>
                <input type="number" name="aforo" min="1" value="{{ old('aforo') }}" required>
            </p>

            
            <button type="submit" class="btn_principal">Enviar propuesta</button>
        </form>
    </section>
</main>
@endsection