<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Programa General TechConf</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 30px;
        }

        h1 {
            text-align: center;
            color: #1f3a56;
            font-size: 26px;
            margin-bottom: 5px;
        }

        h2 {
            color: #1f3a56;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 30px;
        }

        .subtitulo {
            text-align: center;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .taller {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .info {
            background-color: #eef2f3;
            border-left: 4px solid #e74c3c;
            padding: 10px;
            margin-bottom: 10px;
        }

        .info p {
            margin: 4px 0;
        }

        .descripcion {
            margin-top: 10px;
        }

        .plazas {
            font-weight: bold;
            color: #2c3e50;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <h1>TechConf 2026</h1>
    <p class="subtitulo">Programa general de conferencias y talleres tecnológicos</p>

    @foreach($talleres as $taller)
        <div class="taller">
            <h2>{{ $taller->titulo }}</h2>

            <div class="info">
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($taller->fecha)->format('d/m/Y') }}</p>
                <p>
                    <strong>Horario:</strong>
                    {{ \Carbon\Carbon::parse($taller->hora_inicio)->format('H:i') }}
                    -
                    {{ \Carbon\Carbon::parse($taller->hora_fin)->format('H:i') }}
                </p>
                <p><strong>Sala / Aula:</strong> {{ $taller->aula }}</p>
                <p><strong>Ponente principal:</strong> {{ $taller->ponente }}</p>
                <p><strong>Aforo máximo:</strong> {{ $taller->aforo }} plazas</p>
                <p><strong>Inscritos actualmente:</strong> {{ $taller->inscripciones_count }}</p>
                <p class="plazas">
                    Plazas disponibles:
                    {{ $taller->aforo - $taller->inscripciones_count }}
                </p>
                <p><strong>Materiales asociados:</strong></p>
                    <p>{{ $taller->materiales_count }} documento/s disponibles</p>
            </div>

            <div class="descripcion">
                <p><strong>Descripción del taller:</strong></p>
                <p>{{ $taller->descripcion }}</p>
            </div>
        </div>
    @endforeach

    <div class="footer">
        © 2026 Equipo de Tecnologías Web - Programa generado automáticamente desde TechConf
    </div>

</body>
</html>