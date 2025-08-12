<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Actividades Académicas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1000px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions a { margin-right: 5px; text-decoration: none; padding: 3px 8px; border-radius: 3px; }
        .actions button { padding: 3px 8px; border-radius: 3px; cursor: pointer; }
        .create-btn { display: inline-block; background-color: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .success-message { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Actividades Académicas</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('actividades-academicas.create') }}" class="create-btn">Crear Nueva Actividad</a>

        @if($actividades->isEmpty())
            <p>No hay actividades académicas registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Tipo Actividad</th>
                        <th>Req. Mant.</th>
                        <th>Horario</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actividades as $actividad)
                        <tr>
                            <td>{{ $actividad->id }}</td>
                            <td>{{ $actividad->nombre }}</td>
                            <td>{{ $actividad->fecha->format('d/m/Y') }}</td>
                            <td>{{ $actividad->estado }}</td>
                            <td>{{ $actividad->tipo_actividad }}</td>
                            <td>{{ $actividad->requiere_mantenimiento ? 'Sí' : 'No' }}</td>
                            <td>
                                @if($actividad->horario)
                                    {{ $actividad->horario->dia_semana }} ({{ \Carbon\Carbon::parse($actividad->horario->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($actividad->horario->hora_fin)->format('H:i') }})
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $actividad->aula->ubicacion ?? 'N/A' }}</td>
                            <td class="actions">
                                <a href="{{ route('actividades-academicas.show', $actividad->id) }}" style="background-color: #007bff; color: white;">Ver</a>
                                <a href="{{ route('actividades-academicas.edit', $actividad->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('actividades-academicas.destroy', $actividad->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar esta actividad académica?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>