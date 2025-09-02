<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Informático: {{ $informatico->nombre }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Informático: {{ $informatico->nombre }}</h1>
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('informaticos.update', $informatico->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $informatico->nombre) }}" required>
                @error('nombre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="dni">DNI:</label>
                {{-- CAMBIOS AQUI --}}
                <input type="text" id="dni" name="dni" value="{{ old('dni', $informatico->dni) }}" required maxlength="8" pattern="\d{8}" title="El DNI debe tener 8 dígitos numéricos.">
                @error('dni')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $informatico->ubicacion) }}" required>
                @error('ubicacion')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="disponibilidad">Especialidad:</label>
                <input type="text" id="disponibilidad" name="disponibilidad" value="{{ old('disponibilidad', $informatico->disponibilidad) }}" required>
                @error('disponibilidad')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="especialidad">Disponibilidad:</label>
                <input type="text" id="especialidad" name="especialidad" value="{{ old('especialidad', $informatico->especialidad) }}">
                @error('especialidad')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Informatíco</button>
        </form>
        <a href="{{ route('informaticos.show', $informatico->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('informaticos.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>