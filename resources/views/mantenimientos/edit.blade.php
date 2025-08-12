<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Mantenimiento: {{ $mantenimiento->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="date"], select, textarea { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Mantenimiento: {{ $mantenimiento->id }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $mantenimiento->fecha->format('Y-m-d')) }}" required>
                @error('fecha')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado', $mantenimiento->estado) }}" required>
                @error('estado')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_mantenimiento">Tipo de Mantenimiento:</label>
                <input type="text" id="tipo_mantenimiento" name="tipo_mantenimiento" value="{{ old('tipo_mantenimiento', $mantenimiento->tipo_mantenimiento) }}">
                @error('tipo_mantenimiento')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4">{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                @error('descripcion')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="informatico_id">Informático Encargado:</label>
                <select id="informatico_id" name="informatico_id" required>
                    <option value="">Seleccione un Informático</option>
                    @foreach($informaticos as $informatico)
                        <option value="{{ $informatico->id }}" {{ old('informatico_id', $mantenimiento->informatico_id) == $informatico->id ? 'selected' : '' }}>
                            {{ $informatico->nombre }} ({{ $informatico->tipo }})
                        </option>
                    @endforeach
                </select>
                @error('informatico_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Mantenimiento</button>
        </form>
        <a href="{{ route('mantenimientos.show', $mantenimiento->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('mantenimientos.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>