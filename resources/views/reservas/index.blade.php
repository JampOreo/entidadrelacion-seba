<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Reservas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
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
        <h1>Listado de Reservas</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('reservas.create') }}" class="create-btn">Crear Nueva Reserva</a>

        @if($reservas->isEmpty())
            <p>No hay reservas registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Período</th>
                        <th>Turno</th>
                        <th>Día</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <td>{{ $reserva->periodo }}</td>
                            <td>{{ $reserva->turno }}</td>
                            <td>{{ $reserva->dia }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->hora_inicio)->format('H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->hora_fin)->format('H:i') }}</td>
                            <td>{{ $reserva->aula->ubicacion ?? 'N/A' }} (Cap: {{ $reserva->aula->capacidad ?? 'N/A' }})</td>
                            <td class="actions">
                                <a href="{{ route('reservas.show', $reserva->id) }}" style="background-color: #007bff; color: white;">Ver</a>
                                <a href="{{ route('reservas.edit', $reserva->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">Eliminar</button>
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