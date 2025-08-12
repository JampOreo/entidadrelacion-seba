<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Materia</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], select { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        select[multiple] { height: 100px; /* Ajusta la altura para mostrar múltiples opciones */ }
        button { background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #0056b3; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crear Nueva Materia</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materias.store') }}" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_contenido">Tipo de Contenido:</label>
                <input type="text" id="tipo_contenido" name="tipo_contenido" value="{{ old('tipo_contenido') }}">
                @error('tipo_contenido')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado', 'Activa') }}" required>
                @error('estado')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para seleccionar el Aula --}}
            <div>
                <label for="aula_id">Aula:</label>
                <select id="aula_id" name="aula_id" required>
                    <option value="">Seleccione un Aula</option>
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ old('aula_id') == $aula->id ? 'selected' : '' }}>
                            {{ $aula->ubicacion }} (Capacidad: {{ $aula->capacidad }})
                        </option>
                    @endforeach
                </select>
                @error('aula_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para seleccionar Docentes (múltiple) --}}
            <div>
                <label for="docentes">Docentes que dictan esta materia:</label>
                <select id="docentes" name="docentes[]" multiple class="form-control">
                    <option value="">-- Seleccione docentes --</option>
                    @foreach($docentes as $docente)
                        <option value="{{ $docente->id }}"
                            {{ in_array($docente->id, old('docentes', [])) ? 'selected' : '' }}>
                            {{ $docente->nombre }} ({{ $docente->especialidad }})
                        </option>
                    @endforeach
                </select>
                <small style="display: block; margin-top: 5px; color: #666;">
                    Mantén Ctrl (o Cmd en Mac) para seleccionar múltiples docentes.
                </small>
                @error('docentes')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Guardar Materia</button>
        </form>
        <a href="{{ route('materias.index') }}" class="back-link">Volver al Listado</a>
    </div>
</body>
</html>