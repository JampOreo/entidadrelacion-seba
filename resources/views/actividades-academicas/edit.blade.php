<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad Académica: {{ $actividadAcademica->nombre }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="date"], select, input[type="checkbox"] { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="checkbox"] { width: auto; margin-top: 5px;}
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Actividad Académica: {{ $actividadAcademica->nombre }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('actividades-academicas.update', $actividadAcademica->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $actividadAcademica->nombre) }}" required>
                @error('nombre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $actividadAcademica->fecha->format('Y-m-d')) }}" required>
                @error('fecha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado', $actividadAcademica->estado) }}" required>
                @error('estado')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_actividad">Tipo de Actividad:</label>
                <input type="text" id="tipo_actividad" name="tipo_actividad" value="{{ old('tipo_actividad', $actividadAcademica->tipo_actividad) }}" required>
                @error('tipo_actividad')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="requiere_mantenimiento">Requiere Mantenimiento:</label>
                <input type="checkbox" id="requiere_mantenimiento" name="requiere_mantenimiento" value="1" {{ old('requiere_mantenimiento', $actividadAcademica->requiere_mantenimiento) ? 'checked' : '' }}>
                @error('requiere_mantenimiento')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="horario_id">Horario (Opcional):</label>
                <select id="horario_id" name="horario_id">
                    <option value="">Seleccione un Horario</option>
                    @foreach($horarios as $horario)
                        <option value="{{ $horario->id }}" {{ old('horario_id', $actividadAcademica->horario_id) == $horario->id ? 'selected' : '' }}>
                            {{ $horario->dia_semana }} ({{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }})
                        </option>
                    @endforeach
                </select>
                @error('horario_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="aula_id">Aula (Opcional):</label>
                <select id="aula_id" name="aula_id">
                    <option value="">Seleccione un Aula</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('aula_id', $actividadAcademica->aula_id) == $aula->id ? 'selected' : '' }}>
                            {{ $aula->ubicacion }} (Capacidad: {{ $aula->capacidad }})
                        </option>
                    @endforeach
                </select>
                @error('aula_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Actividad</button>
        </form>
        <a href="{{ route('actividades-academicas.show', $actividadAcademica->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('actividades-academicas.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>