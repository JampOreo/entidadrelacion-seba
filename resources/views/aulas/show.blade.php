<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Aula: {{ $aula->ubicacion }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        .detail-item { margin-bottom: 10px; }
        .detail-item strong { display: inline-block; width: 150px; }
        .actions-row { margin-top: 20px; text-align: center; }
        .actions-row a, .actions-row button { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin: 0 5px; }
        .edit-btn { background-color: #ffc107; color: black; border: none; }
        .delete-btn { background-color: #dc3545; color: white; border: none; cursor: pointer; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de Aula</h1>

        <div class="detail-item">
            <strong>ID:</strong> {{ $aula->id }}
        </div>
        <div class="detail-item">
            <strong>Ubicación:</strong> {{ $aula->ubicacion }}
        </div>
        <div class="detail-item">
            <strong>Capacidad:</strong> {{ $aula->capacidad }}
        </div>
        <div class="detail-item">
            <strong>Tipo:</strong> {{ $aula->tipo ?? 'N/A' }}
        </div>
        <div class="detail-item">
            <strong>Creado el:</strong> {{ $aula->created_at->format('d/m/Y H:i') }}
        </div>
        <div class="detail-item">
            <strong>Última Actualización:</strong> {{ $aula->updated_at->format('d/m/Y H:i') }}
        </div>

        <div class="actions-row">
			@include('components.back-to-home')
            <a href="{{ route('aulas.edit', $aula->id) }}" class="edit-btn">Editar</a>
            <form action="{{ route('aulas.destroy', $aula->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta aula?')">Eliminar</button>
            </form>
        </div>
        <a href="{{ route('aulas.index') }}" class="back-link">Volver al Listado</a>
    </div>
</body>
</html>