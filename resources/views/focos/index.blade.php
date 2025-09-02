<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Focos</title>
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
        <h1>Listado de Focos</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('focos.create') }}" class="create-btn">Crear Nuevo Foco</a>

        @if($focos->isEmpty())
            <p>No hay focos registrados.</p>
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
                    @foreach($focos as $foco)
                        <tr>
                            <td>{{ $foco->id }}</td>
                            <td>{{ $foco->marca }}</td>
                            <td>{{ $foco->modelo }}</td>
                            <td>{{ $foco->estado }}</td>
                            <td>{{ $foco->aula->ubicacion }}</td>
                            <td class="actions">
								@include('components.back-to-home')
                                <a href="{{ route('focos.edit', $foco->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('focos.destroy', $foco->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar este foco?')">Eliminar</button>
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