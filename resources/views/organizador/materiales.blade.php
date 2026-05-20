@extends('layouts.app')

@section('contenido')
<div class="container">
    <h1>Materiales de apoyo</h1>

    <p><a href="{{ route('organizador.panel') }}">Volver al panel</a></p>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div>
            <strong>Hay errores en el formulario:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Subir nuevo material</h2>

    <form method="POST" action="{{ route('organizador.materiales.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Taller:</label>
        <select name="taller_id" required>
            <option value="">Selecciona un taller</option>
            @foreach($talleres as $taller)
                <option value="{{ $taller->id }}">
                    {{ $taller->titulo }} - {{ $taller->fecha }}
                </option>
            @endforeach
        </select>

        <br>

        <label>Título del material:</label>
        <input type="text" name="titulo" value="{{ old('titulo') }}" required>

        <br>

        <label>Archivo:</label>
        <input type="file" name="archivo" required>

        <br><br>

        <button type="submit">Subir material</button>
    </form>

    <h2>Materiales subidos</h2>

    @if($materiales->isEmpty())
        <p>No hay materiales subidos todavía.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Taller</th>
                    <th>Archivo</th>
                    <th>Fecha de subida</th>
                </tr>
            </thead>

            <tbody>
                @foreach($materiales as $material)
                    <tr>
                        <td>{{ $material->titulo }}</td>
                        <td>{{ $material->taller->titulo }}</td>
                        <td>
                            <a href="{{ asset('storage/' . $material->archivo) }}" target="_blank">
                                Descargar / Ver archivo
                            </a>
                        </td>
                        <td>{{ $material->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection