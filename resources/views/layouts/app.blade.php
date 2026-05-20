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

        <!-- Espacio reservado para componentes de ancho completo (el banner del index) -->
        @yield('banner')
        
        <div class="contenedor_principal">
            <aside>
                <div class="widget-lateral">
                    <h3>🔍 Buscar Taller</h3>
                    <form action="{{ route('agenda') }}" method="GET" style="display: flex; flex-direction: column; gap: 10px; margin-top: 1rem;">
                        <input type="text" name="buscar" placeholder="Ej. Laravel, IA..." value="{{ request('buscar') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                        <button type="submit" class="btn-buscador">Filtrar Agenda</button>
                        
                        <!-- Botón para limpiar la búsqueda si hay algo escrito -->
                        @if(request()->has('buscar'))
                            <a href="{{ route('agenda') }}" class="enlace-limpio">Limpiar filtro</a>
                        @endif
                    </form>
                </div>

                <div class="widget-lateral">
                    @auth
                        @if(Auth::user()->rol === 'asistente')
                            <h3 class="borde-verde">👤 Mi Resumen</h3>
                            <!-- Contamos las reservas activas en tiempo real -->
                            @php
                                $misReservas = \App\Models\Inscripcion::where('user_id', Auth::id())->count();
                            @endphp
                            <p>Tienes <strong>{{ $misReservas }}</strong> plazas reservadas actualmente.</p>
                            <a href="{{ route('perfil.asistente') }}">Gestionar mis inscripciones &rarr;</a>
                        
                        @elseif(Auth::user()->rol === 'organizador')
                            <h3 class="borde-rojo">⚙️ Administración</h3>
                            <p>Modo de gestión activado.</p>
                            <a href="{{ route('organizador.panel') }}">Ir al Panel de Control &rarr;</a>
                        @endif
                    @else
                        <h3 class="borde-naranja">⚠️ ¿No tienes cuenta?</h3>
                        <p>Inicia sesión para poder reservar tu plaza en las conferencias antes de que se agote el aforo.</p>
                        <a href="{{ route('login') }}">Inicia Sesión Aquí &rarr;</a>
                    @endauth
                </div>

                <div class="widget-lateral">
                    <h3 class="borde-amarillo">📊 Cifras de TechConf</h3>
                    
                    <!-- Calculamos los totales al vuelo usando los modelos -->
                    @php
                        $totalTalleres = \App\Models\Taller::count();
                        $totalInscripciones = \App\Models\Inscripcion::count();
                    @endphp
                    
                    <div class="stats-container">
                        <div>
                            <span class="stat-numero">{{ $totalTalleres }}</span>
                            <span class="stat-etiqueta">Talleres</span>
                        </div>
                        <div>
                            <span class="stat-numero">{{ $totalInscripciones }}</span>
                            <span class="stat-etiqueta">Inscritos</span>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- AQUI SE INYECTARÁ EL CONTENIDO CENTRAL DE CADA PÁGINA -->
            @yield('contenido')

        </div> <!-- Cierra el .contenedor_principal -->

        <footer>
            <p>&copy; 2026 Equipo de Tecnologías Web</p>
            <p>
                <a href="/contacto">Contacto y Datos del Desarrollador</a> |
                <a href="{{ asset('pdf/como_se_hizo.pdf') }}" target="_blank">Informe: Cómo se hizo (PDF)</a>
            </p>
        </footer>
    </body>
</html>
