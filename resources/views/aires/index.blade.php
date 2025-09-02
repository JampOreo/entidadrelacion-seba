<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Aires Acondicionados</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .actions a { margin-right: 5px; text-decoration: none; padding: 3px 8px; border-radius: 3px; }
        .actions button { padding: 3px 8px; border-radius: 3px; cursor: pointer; }
        .create-btn { display: inline-block; background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .success-message { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Aires Acondicionados</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('aires.create') }}" class="create-btn">Crear Nuevo Aire Acondicionado</a>

        @if($aires->isEmpty())
            <p>No hay aires acondicionados registrados.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Aula</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aires as $aire)
                        <tr>
                            <td>{{ $aire->id }}</td>
                            <td>{{ $aire->marca }}</td>
                            <td>{{ $aire->modelo }}</td>
                            <td>{{ $aire->estado }}</td>
                            <td>{{ $aire->aula->ubicacion }}</td>
                            <td class="actions">
								@include('components.back-to-home')
                                <a href="{{ route('aires.edit', $aire->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('aires.destroy', $aire->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar este aire acondicionado?')">Eliminar</button>
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