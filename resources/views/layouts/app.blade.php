<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>TechConf - Gestor de Eventos</title>
        
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    </head>
    <body>
        <header>
            <div class="logo">
                <h1>TechConf</h1>
            </div>
            <nav>
                <ul>
                    <!-- Cambiamos los .php por las rutas limpias de Laravel -->
                    <li><a href="/">Agenda</a></li>
                    <li><a href="/contacto">Contacto</a></li>
                </ul>
                    
                <!-- Aquí implementaremos la lógica de login -->
                <div class="user-status-zone" style="float: right;">
                    @auth
                        <span>Bienvenido, <strong>{{ Auth::user()->name }}</strong> ({{ ucfirst(Auth::user()->rol) }})</span>
                        @if(Auth::user()->rol === 'asistente')
                            <a href="/perfil" class="btn-perfil">Mi Perfil</a>
                        @else
                            <a href="/panel-organizador" class="btn-perfil">Panel Control</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-logout">Cerrar Sesión</button>
                        </form>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
                    @endguest
                </div>
            </nav>
        </header>
        
        <div class="contenedor-principal">
            <aside>
                <h2>Temáticas</h2>
                <ul>
                    <li><a href="#">Inteligencia Artificial</a></li>
                    <li><a href="#">Desarrollo Web</a></li>
                    <li><a href="#">Ciberseguridad</a></li>
                </ul>
            </aside>

            <!-- AQUI SE INYECTARÁ EL CONTENIDO CENTRAL DE CADA PÁGINA -->
            @yield('contenido')

        </div> <!-- Cierra el .contenedor-principal -->

        <footer>
            <p>&copy; 2026 Equipo de Tecnologías Web</p>
            <p>
                <a href="/contacto">Contacto y Datos del Desarrollador</a> |
                <a href="{{ asset('pdf/como_se_hizo.pdf') }}" target="_blank">Informe: Cómo se hizo (PDF)</a>
            </p>
        </footer>
    </body>
</html>
