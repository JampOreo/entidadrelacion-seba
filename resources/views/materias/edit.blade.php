<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Materia: {{ $materia->nombre }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        form div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], select { width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        select[multiple] { height: 100px; /* Ajusta la altura para mostrar múltiples opciones */ }
        button { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; margin-right: 10px; }
        button:hover { background-color: #218838; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Materia: {{ $materia->nombre }}</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materias.update', $materia->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Importante para indicar que es una actualización --}}
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $materia->nombre) }}" required>
                @error('nombre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="tipo_contenido">Tipo de Contenido:</label>
                <input type="text" id="tipo_contenido" name="tipo_contenido" value="{{ old('tipo_contenido', $materia->tipo_contenido) }}">
                @error('tipo_contenido')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="{{ old('estado', $materia->estado) }}" required>
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
                        <option value="{{ $aula->id }}" {{ old('aula_id', $materia->aula_id) == $aula->id ? 'selected' : '' }}>
                            {{ $aula->ubicacion }} (Capacidad: {{ $aula->capacidad }})
                        </option>
                    @endforeach
                </select>
                @error('aula_id')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            {{-- Campo para seleccionar Docentes (múltiple) --}}
			<div class="form-group">
				<label for="docentes">Docentes que dictan esta materia:</label>
				<select id="docentes" name="docentes[]" multiple class="form-control">
					{{-- Obtener los IDs de los docentes asociados actualmente a esta materia --}}
					@php
						$currentDocenteIds = $materia->docentes->pluck('id')->toArray();
					@endphp
					@foreach($docentes as $docente)
						<option value="{{ $docente->id }}"
							{{ in_array($docente->id, old('docentes', $currentDocenteIds)) ? 'selected' : '' }}>
							{{ $docente->nombre }} ({{ $docente->especialidad }})
						</option>
					@endforeach
				</select>
				<small class="text-muted">Mantén Ctrl (o Cmd en Mac) para seleccionar múltiples docentes.</small>
				@error('docentes')
					<small class="text-danger">{{ $message }}</small>
				@enderror
			</div>

            <button type="submit">Actualizar Materia</button>
        </form>
        <a href="{{ route('materias.show', $materia->id) }}" class="back-link">Volver a Detalles</a>
        <a href="{{ route('materias.index') }}" class="back-link" style="margin-left: 10px;">Volver al Listado</a>
    </div>
</body>
</html>