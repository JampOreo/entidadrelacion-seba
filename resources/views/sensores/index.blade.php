<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Sensores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 900px; margin: auto; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .back-link { display: inline-block; margin-top: 20px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos de Sensores del Aula</h1>
        <p>Aquí puedes ver los últimos datos registrados por el ESP32.</p>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                {{-- Aquí se iterarán los datos de los sensores --}}
                @foreach($sensores as $sensor)
                    <tr>
                        <td>{{ $sensor->id }}</td>
                        <td>{{ $sensor->tipo }}</td>
                        <td>{{ $sensor->valor }}</td>
                        <td>{{ $sensor->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('welcome') }}" class="back-link">Volver al Menú Principal</a>
    </div>
</body>
</html>