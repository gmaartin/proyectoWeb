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
    <a href="{{ asset('pdf/programa_general.pdf') }}" class="boton_descarga" download>Descargar Programa General</a>

    <section class="lista-eventos">
        <!-- Esto es "estático" por ahora, luego la Persona 3 lo rellenará usando foreach de Blade -->
        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Introducción a React y APIs</h3>
            <p><strong>Horario:</strong> 10:00 - 12:00 | <strong>Sala:</strong> Turing</p>
            <p>Aprende las bases del desarrollo web moderno con esta tecnología.</p>
            <!-- URL adaptada al estilo Laravel -->
            <a href="/evento/1">Ver detalles del taller</a>
        </article>
        
        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Seguridad en Servidores Linux</h3>
            <p><strong>Horario:</strong> 12:30 - 14:00 | <strong>Sala:</strong> Lovelace</p>
            <p>Taller práctico sobre fortificación de servidores.</p>
            <a href="/evento/2">Ver detalles del taller</a>
        </article>

        <article class="evento-card" style="border: 1px solid #ccc; padding: 1rem; margin-bottom: 1rem;">
            <h3>Charla IoT definitiva</h3>
            <p><strong>Horario:</strong> 16:00 - 18:00 | <strong>Sala:</strong> Salon Conferencias ETSIIT</p>
            <p>Charla detallada sobre el Internet de las Cosas (IoT).</p>
            <a href="/evento/3">Ver detalles del taller</a>
        </article>
    </section>
</main>
@endsection