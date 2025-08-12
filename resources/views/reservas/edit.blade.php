<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva: {{ $reserva->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="time"], select { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Reserva: {{ $reserva->id }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="periodo">Período:</label>
                <input type="text" id="periodo" name="periodo" value="{{ old('periodo', $reserva->periodo) }}" required>
                @error('periodo')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="turno">Turno:</label>
                <input type="text" id="turno" name="turno" value="{{ old('turno', $reserva->turno) }}" required>
                @error('turno')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="dia">Día:</label>
                <input type="text" id="dia" name="dia" value="{{ old('dia', $reserva->dia) }}" required>
                @error('dia')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="hora_inicio">Hora Inicio:</label>
                <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio', \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i')) }}" required>
                @error('hora_inicio')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="hora_fin">Hora Fin:</label>
                <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin', \Carbon\Carbon::parse($reserva->hora_fin)->format('H:i')) }}" required>
                @error('hora_fin')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_disponibilidad">Tipo de Disponibilidad:</label>
                <input type="text" id="tipo_disponibilidad" name="tipo_disponibilidad" value="{{ old('tipo_disponibilidad', $reserva->tipo_disponibilidad) }}">
                @error('tipo_disponibilidad')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="aula_id">Aula:</label>
                <select id="aula_id" name="aula_id" required>
                    <option value="">Seleccione un Aula</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('aula_id', $reserva->aula_id) == $aula->id ? 'selected' : '' }}>
                            {{ $aula->ubicacion }} (Capacidad: {{ $aula->capacidad }})
                        </option>
                    @endforeach
                </select>
                @error('aula_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Reserva</button>
        </form>
        <a href="{{ route('reservas.show', $reserva->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('reservas.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>