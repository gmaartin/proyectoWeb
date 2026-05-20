@extends('layouts.app')

@section('contenido')
<main>
    <!-- Inyectamos el componente de alertas para los mensajes de éxito/error -->
    @include('alertas')

    <h2>Mi Área Personal</h2>
    
    <div class="developer_info" style="margin-bottom: 2rem;">
        <h3>Datos del Asistente</h3>
        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <h3>Mis Talleres Reservados</h3>

    @if($inscripciones->count() > 0)
        <table class="tabla-perfil">
            <thead>
                <tr>
                    <th>Taller</th>
                    <th>Fecha y Hora</th>
                    <th>Aula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inscripciones as $inscripcion)
                    <tr>
                        <td>
                            <a href="{{ route('taller.detalle', $inscripcion->taller->id) }}" style="color: #2980b9; text-decoration: none;">
                                {{ $inscripcion->taller->titulo }}
                            </a>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($inscripcion->taller->fecha)->format('d/m/Y') }}<br>
                            <small>{{ \Carbon\Carbon::parse($inscripcion->taller->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($inscripcion->taller->hora_fin)->format('H:i') }}</small>
                        </td>
                        <td>
                            {{ $inscripcion->taller->aula }}
                        </td>
                        <td class="text-center">
                            <!-- Formulario para botón de cancelar usando el método DELETE -->
                            <form action="{{ route('inscripcion.cancelar', $inscripcion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu plaza en este taller?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-cancelar">
                                    Cancelar Plaza
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="estado-vacio">
            <p>Aún no te has inscrito en ningún taller.</p>
            <a href="/">Ver la agenda de conferencias</a>
        </div>
    @endif
</main>
@endsection