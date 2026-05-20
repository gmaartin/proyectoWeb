@if ($errors->any())
    <div class="alerta alerta-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alerta alerta-exito">
        {{ session('success') }}
    </div>
@endif