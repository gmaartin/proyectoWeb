@extends('layouts.app')

@section('contenido')
<main>
    <section class="ficha_evento">
        <h2 class="titulo_evento">Propuestas de eventos</h2>

        <p>
            <a href="{{ route('organizador.panel') }}" class="enlace-volver">Volver al panel</a>
        </p>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if($propuestas->isEmpty())
            <p>No hay propuestas registradas.</p>
        @else
            <table class="tabla-datos">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Título</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Aula</th>
                        <th>Aforo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($propuestas as $propuesta)
                        <tr>
                            <td>{{ $propuesta->user->name }}</td>
                            <td>{{ $propuesta->titulo }}</td>
                            <td>{{ \Carbon\Carbon::parse($propuesta->fecha)->format('d/m/Y') }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($propuesta->hora_inicio)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($propuesta->hora_fin)->format('H:i') }}
                            </td>
                            <td>{{ $propuesta->aula }}</td>
                            <td>{{ $propuesta->aforo }}</td>
                            <td>{{ ucfirst($propuesta->estado) }}</td>
                            <td>
                                @if($propuesta->estado === 'pendiente')
                                    <form method="POST" action="{{ route('organizador.propuestas.aceptar', $propuesta) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-accion btn-info">Aceptar</button>
                                    </form>

                                    <form method="POST" action="{{ route('organizador.propuestas.rechazar', $propuesta) }}" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="comentario_organizador" value="Propuesta rechazada por el organizador.">
                                        <button type="submit" class="btn-accion btn-eliminar">Rechazar</button>
                                    </form>
                                @else
                                    Sin acciones
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td colspan="8">
                                <strong>Descripción:</strong> {{ $propuesta->descripcion }}<br>
                                <strong>Ponente:</strong> {{ $propuesta->ponente }}<br>
                                @if($propuesta->comentario_organizador)
                                    <strong>Comentario:</strong> {{ $propuesta->comentario_organizador }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </section>
</main>
@endsection