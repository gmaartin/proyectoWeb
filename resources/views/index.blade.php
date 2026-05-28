<!-- 1. Le decimos que extienda de nuestra plantilla maestra -->
@extends('layouts.app')

<!-- 2. Definimos lo que va dentro de @yield('banner') -->
@section('banner')
<div class="banner_index">
    <img src="{{ asset('img/banner.png') }}" alt="TechConf - Agenda Global de Conferencias">
</div>
@endsection

<!-- 3. Definimos lo que va dentro de @yield('contenido') -->
@section('contenido')
<main>
    <h2>Agenda de Conferencias</h2>
    <p>Bienvenido al evento tecnológico del año. Consulta nuestros talleres y reserva tu plaza.</p>
    
    <!-- Enlace de descarga del programa general apuntando a la carpeta public -->
    <a href="{{ route('programa.pdf') }}" class="boton_descarga">
    Descargar Programa General
</a>

@auth
    @if(Auth::user()->rol === 'asistente')
        <a href="{{ route('propuestas.crear') }}" class="boton_descarga">
            Proponer nuevo evento
        </a>
    @endif
@endauth

    <section class="lista-eventos">
        <!-- Iteración dinámica sobre la colección de talleres de la base de datos -->
        @forelse($talleres as $taller)
            <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
                <h3>{{ $taller->titulo }}</h3>
                
                <p>
                    <strong>Horario:</strong> 
                    {{ \Carbon\Carbon::parse($taller->hora_inicio)->format('H:i') }} - 
                    {{ \Carbon\Carbon::parse($taller->hora_fin)->format('H:i') }} 
                    | <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($taller->fecha)->format('d/m/Y') }}
                    | <strong>Sala/Aula:</strong> {{ $taller->aula }}
                </p>
                
                <p>{{ $taller->descripcion }}</p>
                <p><strong>Ponente:</strong> {{ $taller->ponente }}</p>
                <p><strong>Plazas disponibles:</strong> {{ $taller->aforo - $taller->inscripciones_count }} de {{ $taller->aforo }}</p>
                
                <!-- Enlace dinámico utilizando el ID único del registro -->
                <a href="/evento/{{ $taller->id }}">Ver detalles del taller</a>
            </article>
        @empty
            <!-- Bloque alternativo en caso de que no existan registros o la BD esté limpia -->
            <div class="sin-eventos" style="padding: 2rem; text-align: center; background-color: #f9f9f9; border: 1px dashed #ccc;">
                <p>Actualmente no hay talleres programados en la agenda. Por favor, vuelva a consultar más tarde.</p>
            </div>
        @endforelse
    </section>
</main>
@endsection