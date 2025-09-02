<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Materias</title>
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
        <h1>Listado de Materias</h1>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('materias.create') }}" class="create-btn">Crear Nueva Materia</a>

        @if($materias->isEmpty())
            <p>No hay materias registradas.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo Contenido</th>
                        <th>Estado</th>
                        <th>Aula</th> {{-- Nueva columna para Aula --}}
                        <th>Docentes</th> {{-- Nueva columna para Docentes --}}
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($materias as $materia)
                        <tr>
                            <td>{{ $materia->id }}</td>
                            <td>{{ $materia->nombre }}</td>
                            <td>{{ $materia->tipo_contenido ?? 'N/A' }}</td>
                            <td>{{ $materia->estado }}</td>
                            <td>{{ $materia->aula->ubicacion ?? 'N/A' }}</td> {{-- Accede a la relación aula --}}
                            <td>
                                @if($materia->docentes->isNotEmpty())
                                    {{ $materia->docentes->pluck('nombre')->implode(', ') }}
                                @else
                                    N/A
                                @endif
                            </td> {{-- Accede a la relación docentes --}}
                            <td class="actions">
								@include('components.back-to-home')
                                <a href="{{ route('materias.show', $materia->id) }}" style="background-color: #007bff; color: white;">Ver</a>
                                <a href="{{ route('materias.edit', $materia->id) }}" style="background-color: #ffc107; color: black;">Editar</a>
                                <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none;" onclick="return confirm('¿Estás seguro de eliminar esta materia?')">Eliminar</button>
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