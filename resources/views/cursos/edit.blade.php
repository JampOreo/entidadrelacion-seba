<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso: {{ $curso->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Curso: {{ $curso->id }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $curso->ubicacion) }}">
                @error('ubicacion')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" value="{{ old('capacidad', $curso->capacidad) }}">
                @error('capacidad')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar Curso</button>
        </form>
        <a href="{{ route('cursos.show', $curso->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('cursos.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>