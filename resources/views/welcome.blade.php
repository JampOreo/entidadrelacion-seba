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
        /* Estilos para el botón secreto de imagen */
        #secret-button-image {
            max-width: 150px; /* Tamaño máximo para la imagen */
            height: auto;
            cursor: pointer;
            border-radius: 8px; /* Opcional: para que coincida con el estilo de los otros botones */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }
        #secret-button-image:hover {
            transform: scale(1.05); /* Pequeño efecto al pasar el ratón */
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
            <li><a href="{{ route('aulas.index') }}">Gestión de Aulas</a></li>
            <li><a href="{{ route('focos.index') }}">Gestión de Focos</a></li>
            <li><a href="{{ route('aires.index') }}">Gestión de Aires Acondicionados</a></li>
            <li><a href="{{ route('informaticos.index') }}">Gestión de Informáticos</a></li>
            <li><a href="{{ route('mantenimientos.index') }}">Gestión de Mantenimientos</a></li>
            <li><a href="{{ route('horarios.index') }}">Gestión de Horarios</a></li>
            <li><a href="{{ route('reservas.index') }}">Gestión de Reservas</a></li>
            <li><a href="{{ route('sensores.index') }}">Gestión de Sensores</a></li>
            <li id="secret-button" style="display: none;">
                <img id="secret-button-image" src="https://tse1.explicit.bing.net/th/id/OIP.euqcKdvOqvf3vSIfFsa-FQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Boton Secreto">
            </li>
        </ul>
    </div>

    {{-- Elementos de audio ocultos --}}
    <audio id="top-secret-audio" src="{{ asset('topsecret.mp3') }}"></audio>
    <audio id="pena-terrible-audio" src="{{ asset('penaterrible.mp3') }}"></audio>

    <script>
        let keyCount = 0;
        const secretButton = document.getElementById('secret-button');
        const secretButtonImage = document.getElementById('secret-button-image');
        const audioTopSecret = document.getElementById('top-secret-audio');
        const audioPenaTerrible = document.getElementById('pena-terrible-audio');
        let buttonEventAdded = false;

        document.addEventListener('keydown', function(event) {
            if (event.key === 'j' || event.key === 'J') {
                keyCount++;
                if (keyCount >= 4) {
                    secretButton.style.display = 'block';
                    keyCount = 0;
                    
                    if (!buttonEventAdded) {
                        secretButtonImage.addEventListener('click', function(e) {
                            e.preventDefault();
                            
                            // Reproduce el audio "top-secret" al hacer clic
                            audioTopSecret.pause();
                            audioTopSecret.currentTime = 0;
                            audioTopSecret.play();

                            // Lógica de autodestrucción
                            const randomNumber = Math.floor(Math.random() * 6) + 1;
                            if (randomNumber === 1) {
                                // Reproduce el audio "pena terrible" aquí, justo antes de la alerta
                                audioPenaTerrible.pause();
                                audioPenaTerrible.currentTime = 0;
                                audioPenaTerrible.play();
                                
                                alert('si... es una pena terrible...');
                                secretButton.style.display = 'none';
                                buttonEventAdded = false;
                            }
                        });
                        buttonEventAdded = true;
                    }
                }
            } else {
                keyCount = 0;
            }
        });
    </script>
</body>
</html>