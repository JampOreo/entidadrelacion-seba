<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Horario: {{ $horario->dia_semana }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="time"] { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Horario: {{ $horario->dia_semana }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('horarios.update', $horario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="dia_semana">Día de la Semana:</label>
                <input type="text" id="dia_semana" name="dia_semana" value="{{ old('dia_semana', $horario->dia_semana) }}" required>
                @error('dia_semana')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="hora_inicio">Hora Inicio:</label>
                <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio', \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i')) }}" required>
                @error('hora_inicio')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="hora_fin">Hora Fin:</label>
                <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin', \Carbon\Carbon::parse($horario->hora_fin)->format('H:i')) }}" required>
                @error('hora_fin')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_horario">Tipo de Horario:</label>
                <input type="text" id="tipo_horario" name="tipo_horario" value="{{ old('tipo_horario', $horario->tipo_horario) }}">
                @error('tipo_horario')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado', $horario->estado) }}" required>
                @error('estado')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Horario</button>
        </form>
        <a href="{{ route('horarios.show', $horario->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('horarios.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>