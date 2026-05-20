@extends('layouts.app')

@section('contenido')
<main>
    <!-- Inyectamos las alertas aquí, dentro del contenedor central -->
    @include('alertas')

    <!-- Contenedor de la ficha del evento usando los estilos del equipo -->
    <section class="ficha_evento">
        <h2 class="titulo_evento">{{ $taller->titulo }}</h2>
        
        <div class="info_tecnica">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($taller->fecha)->format('d/m/Y') }}</p>
            <p><strong>Horario:</strong> {{ \Carbon\Carbon::parse($taller->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($taller->hora_fin)->format('H:i') }}.</p>
            <p><strong>Sala / Aula:</strong> {{ $taller->aula }}</p>
            <p><strong>Ponente principal:</strong> {{ $taller->ponente }}</p>
            <p><strong>Aforo máximo:</strong> {{ $taller->aforo }} plazas</p>
        </div>

        <div class="descripcion_evento">
            <h3>Descripción del Taller</h3>
            <p>{{ $taller->descripcion }}</p>
        </div>

        <!-- LÓGICA DE INSCRIPCIÓN SEGÚN EL ESTADO DE LA SESIÓN -->
        @auth
            @if(Auth::user()->rol === 'asistente')
                <!-- Si es un asistente logueado, se le permite enviar la petición POST de inscripción -->
                <form action="{{ route('taller.inscribir', $taller->id) }}" method="POST" class="zona_inscripcion">
                    @csrf
                    <button type="submit" class="btn_principal">Inscribirse en este taller</button>
                </form>
            @else
                <!-- Si es un organizador, se le indica que las inscripciones son para asistentes -->
                <div class="zona_inscripcion">
                    <p style="color: #7f8c8d; font-style: italic;">Vista de organizador: Las inscripciones están reservadas para las cuentas de tipo asistente.</p>
                </div>
            @endif
        @endauth

        @guest
            <!-- Si no hay sesión iniciada, se bloquea el botón y se redirige de forma elegante al login -->
            <div class="zona_inscripcion" style="background-color: #f8d7da; padding: 1rem; border-radius: 4px; margin-top: 2rem;">
                <p style="color: #721c24; margin: 0;">
                    Para poder reservar tu plaza en esta conferencia, necesitas tener una cuenta. 
                    <a href="{{ route('login') }}" style="font-weight: bold; color: #721c24; text-decoration: underline;">Inicia sesión aquí</a>.
                </p>
            </div>
        @endguest

        <div style="margin-top: 2rem;">
            <a href="/" style="text-decoration: none; color: #3498db;">&larr; Volver a la agenda global</a>
        </div>
    </section>
</main>
@endsection