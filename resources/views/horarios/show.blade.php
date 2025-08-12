<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Horario: {{ $horario->dia_semana }}</title>
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
        <h1>Detalles de Horario</h1>

        <div class="detail-item">
            <strong>ID:</strong> {{ $horario->id }}
        </div>
        <div class="detail-item">
            <strong>Día de la Semana:</strong> {{ $horario->dia_semana }}
        </div>
        <div class="detail-item">
            <strong>Hora Inicio:</strong> {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
        </div>
        <div class="detail-item">
            <strong>Hora Fin:</strong> {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
        </div>
        <div class="detail-item">
            <strong>Tipo Horario:</strong> {{ $horario->tipo_horario ?? 'N/A' }}
        </div>
        <div class="detail-item">
            <strong>Estado:</strong> {{ $horario->estado }}
        </div>
        <div class="detail-item">
            <strong>Creado el:</strong> {{ $horario->created_at->format('d/m/Y H:i') }}
        </div>
        <div class="detail-item">
            <strong>Última Actualización:</strong> {{ $horario->updated_at->format('d/m/Y H:i') }}
        </div>

        <div class="actions-row">
            <a href="{{ route('horarios.edit', $horario->id) }}" class="edit-btn">Editar</a>
            <form action="{{ route('horarios.destroy', $horario->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar este horario?')">Eliminar</button>
            </form>
        </div>
        <a href="{{ route('horarios.index') }}" class="back-link">Volver al Listado</a>
    </div>
</body>
</html>