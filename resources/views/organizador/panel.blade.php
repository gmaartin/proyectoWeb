@extends('layouts.app')

@section('contenido')
<div class="ficha_evento">
    <h1>Panel del organizador</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <p>Desde este panel puedes gestionar los talleres, consultar inscritos y subir materiales de apoyo.</p>

    <nav>
        <ul class="menu-acciones-panel">
            <li><a href="{{ route('organizador.inscritos') }}">Ver inscritos</a></li>
            <li><a href="{{ route('organizador.talleres.crear') }}">Crear nuevo taller</a></li>
            <li><a href="{{ route('organizador.materiales') }}">Gestionar materiales</a></li>
            <li><a href="{{ route('organizador.propuestas') }}">Revisar propuestas</a></li>
        </ul>
    </nav>

    <h2>Talleres registrados</h2>

    @if($talleres->isEmpty())
        <p>No hay talleres registrados.</p>
    @else
        <table class="tabla-datos">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Ponente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Aula</th>
                    <th>Aforo</th>
                    <th>Inscritos</th>
                    <th>Plazas libres</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($talleres as $taller)
                    <tr>
                        <td>{{ $taller->titulo }}</td>
                        <td>{{ $taller->ponente }}</td>
                        <td>{{ $taller->fecha }}</td>
                        <td>{{ $taller->hora_inicio }} - {{ $taller->hora_fin }}</td>
                        <td>{{ $taller->aula }}</td>
                        <td>{{ $taller->aforo }}</td>
                        <td>{{ $taller->inscripciones_count }}</td>
                        <td>{{ $taller->aforo - $taller->inscripciones_count }}</td>
                        <td>
                            <a a href="{{ route('organizador.talleres.editar', $taller) }}" class="btn-accion btn-editar">
                                Editar
                            </a>

                            <form method="POST" action="{{ route('organizador.talleres.eliminar', $taller) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-accion btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este taller?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection