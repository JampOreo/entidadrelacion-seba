<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Actividad Académica: {{ $actividadAcademica->nombre }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        .detail-item { margin-bottom: 10px; }
        .detail-item strong { display: inline-block; width: 180px; } /* Ajustado para nombres más largos */
        .actions-row { margin-top: 20px; text-align: center; }
        .actions-row a, .actions-row button { padding: 8px 15px; border-radius: 4px; text-decoration: none; margin: 0 5px; }
        .edit-btn { background-color: #ffc107; color: black; border: none; }
        .delete-btn { background-color: #dc3545; color: white; border: none; cursor: pointer; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles de Actividad Académica</h1>

        <div class="detail-item">
            <strong>ID:</strong> {{ $actividadAcademica->id }}
        </div>
        <div class="detail-item">
            <strong>Nombre:</strong> {{ $actividadAcademica->nombre }}
        </div>
        <div class="detail-item">
            <strong>Fecha:</strong> {{ $actividadAcademica->fecha->format('d/m/Y') }}
        </div>
        <div class="detail-item">
            <strong>Estado:</strong> {{ $actividadAcademica->estado }}
        </div>
        <div class="detail-item">
            <strong>Tipo de Actividad:</strong> {{ $actividadAcademica->tipo_actividad }}
        </div>
        <div class="detail-item">
            <strong>Requiere Mantenimiento:</strong> {{ $actividadAcademica->requiere_mantenimiento ? 'Sí' : 'No' }}
        </div>
        <div class="detail-item">
            <strong>Horario Asociado:</strong>
            @if($actividadAcademica->horario)
                {{ $actividadAcademica->horario->dia_semana }} ({{ \Carbon\Carbon::parse($actividadAcademica->horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividadAcademica->horario->hora_fin)->format('H:i') }})
            @else
                N/A
            @endif
        </div>
        <div class="detail-item">
            <strong>Aula Asociada:</strong> {{ $actividadAcademica->aula->ubicacion ?? 'N/A' }}
        </div>
        <div class="detail-item">
            <strong>Creado el:</strong> {{ $actividadAcademica->created_at->format('d/m/Y H:i') }}
        </div>
        <div class="detail-item">
            <strong>Última Actualización:</strong> {{ $actividadAcademica->updated_at->format('d/m/Y H:i') }}
        </div>

        <div class="actions-row">
            <a href="{{ route('actividades-academicas.edit', $actividadAcademica->id) }}" class="edit-btn">Editar</a>
            <form action="{{ route('actividades-academicas.destroy', $actividadAcademica->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de eliminar esta actividad académica?')">Eliminar</button>
            </form>
        </div>
        <a href="{{ route('actividades-academicas.index') }}" class="back-link">Volver al Listado</a>
    </div>
</body>
</html>