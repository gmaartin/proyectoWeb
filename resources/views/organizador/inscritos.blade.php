@extends('layouts.app')

@section('contenido')
<div class="ficha_evento">
    <h1>Control de inscritos</h1>

    <p><a href="{{ route('organizador.panel') }}" class="enlace-volver">Volver al panel</a></p>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($inscripciones->isEmpty())
        <p>Todavía no hay inscripciones registradas.</p>
    @else
        <table class="tabla-datos">
            <thead>
                <tr>
                    <th>Asistente</th>
                    <th>Email</th>
                    <th>Taller</th>
                    <th>Fecha de inscripción</th>
                    <th>Asistió</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                @foreach($inscripciones as $inscripcion)
                    <tr>
                        <td>{{ $inscripcion->user->name }}</td>
                        <td>{{ $inscripcion->user->email }}</td>
                        <td>{{ $inscripcion->taller->titulo }}</td>
                        <td>{{ $inscripcion->created_at }}</td>
                        <td>
                            @if($inscripcion->asistio)
                                Sí
                            @else
                                No
                            @endif
                        </td>
                        <td>
                            @if($inscripcion->asistio)
                                <form method="POST" action="{{ route('organizador.inscripciones.asistencia', $inscripcion) }}">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="asistio" value="0">

                                    <button type="submit" class="btn-accion btn-eliminar">Marcar como no asistió</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('organizador.inscripciones.asistencia', $inscripcion) }}">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="asistio" value="1">

                                    <button type="submit" class="btn-accion btn-info">Marcar como asistió</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection