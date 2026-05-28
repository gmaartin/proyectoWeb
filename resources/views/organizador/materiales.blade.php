@extends('layouts.app')

@section('contenido')
<div>
    <h1>Materiales de apoyo</h1>

    <p><a href="{{ route('organizador.panel') }}" class="enlace-volver">Volver al panel</a></p>

    @include('alertas')

    <h2>Subir nuevo material</h2>

    <form method="POST" action="{{ route('organizador.materiales.store') }}" enctype="multipart/form-data" class="formulario-admin">
        @csrf
        <label>Taller:</label>
        <select name="taller_id" required>
            <option value="">Selecciona un taller</option>
            @foreach($talleres as $taller)
                <option value="{{ $taller->id }}">
                    {{ $taller->titulo }} - {{ \Carbon\Carbon::parse($taller->fecha)->format('d/m/Y') }}
                </option>
            @endforeach
        </select>        

        <label>Título del material:</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required>

        

        <label>Archivo:</label>
        <input type="file" name="archivo" required>      


        <button type="submit" class="btn_principal">Subir material</button>
    </form>

    <h2>Materiales subidos</h2>

    @if($materiales->isEmpty())
        <div>
            <p>No hay materiales subidos todavía.</p>
        </div>
    @else
        <table class="tabla-datos">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Taller</th>
                    <th>Archivo</th>
                    <th>Fecha de subida</th>
                    <th>Acciones</th> {{-- NUEVA COLUMNA --}}
                </tr>
            </thead>
            <tbody>
                @foreach($materiales as $material)
                    <tr>
                        <td>{{ $material->titulo }}</td>
                        <td>{{ $material->taller->titulo }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $material->archivo) }}" target="_blank" class="btn-accion btn-info">
                                Descargar / Ver archivo

                            </a>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($material->created_at)->format('d/m/Y') }}</td>
                        
                        <td>
                            <form action="{{ route('organizador.materiales.eliminar', $material->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este material?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-cancelar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection