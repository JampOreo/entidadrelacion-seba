<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Informáticos</title>
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
        <h1>Listado de Informáticos</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('informaticos.create') }}" class="create-btn">Inscribir Nuevo Informático</a>

        @if($informaticos->isEmpty())
            <p>No hay informáticos registrados.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Ubicación</th>
                        <th>Disponibilidad</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($informaticos as $informatico)
                        <tr>
                            <td>{{ $informatico->id }}</td>
                            <td>{{ $informatico->nombre }}</td>
                            <td>{{ $informatico->dni }}</td>
                            <td>{{ $informatico->ubicacion }}</td>
                            <td>{{ $informatico->disponibilidad }}</td>
                            <td>{{ $informatico->especialidad }}</td>
                            <td class="actions">
                                <a href="{{ route('informaticos.show', $informatico->id) }}" style="background-color: #007bff; color: white;">Ver</a>
                                <a href="{{ route('informaticos.edit', $informatico->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('informaticos.destroy', $informatico->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar a este informático?')">Eliminar</button>
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