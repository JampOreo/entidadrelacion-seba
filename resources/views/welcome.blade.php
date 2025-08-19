<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hola profe seBa :v</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #0056b3;
            margin-bottom: 20px;
        }
        .navigation-list {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .navigation-list a {
            display: block;
            padding: 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            width: 250px;
            text-align: center;
        }
        .navigation-list a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido al Sistema de Gestión del Aula</h1>
        <p>Selecciona una opción para gestionar los recursos:</p>
        <ul class="navigation-list">
			<li><a href="{{ route('materias.index') }}">Gestión de Materias</a></li>
			<li><a href="{{ route('docentes.index') }}">Gestión de Docentes</a></li>
			<li><a href="{{ route('cursos.index') }}">Gestión de Cursos</a></li>
			<li><a href="{{ route('aulas.index') }}">Gestión de Aulas</a></li>
			<li><a href="{{ route('focos.index') }}">Gestión de Focos</a></li>
			<li><a href="{{ route('aires.index') }}">Gestión de Aires Acondicionados</a></li>
			<li><a href="{{ route('informaticos.index') }}">Gestión de Recursos Informáticos</a></li>
			<li><a href="{{ route('mantenimientos.index') }}">Gestión de Mantenimientos</a></li>
			<li><a href="{{ route('horarios.index') }}">Gestión de Horarios</a></li>
			<li><a href="{{ route('reservas.index') }}">Gestión de Reservas</a></li>
		</ul>
    </div>
</body>
</html>