<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Sensores | Aula Inteligente</title>
    
    {{-- Agrega Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f7f6; }
        .container { 
            max-width: 1000px; 
            margin: auto; 
            background: #fff; 
            padding: 30px; 
            border-radius: 10px; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
            position: relative; 
            /* CORRECCIÓN 1: Asegura que el fondo blanco cubra todo. */
            min-height: 800px; 
            padding-bottom: 70px; /* Espacio para el enlace */
        }
        h1 { text-align: center; color: #007bff; margin-bottom: 20px; }
        
        /* Estilos de la tabla */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #e9ecef; color: #333; }
        
        /* Estilos del Switch de Visualización */
        .switch-container { text-align: center; margin-bottom: 30px; }
        .switch-label { font-size: 1.1em; font-weight: bold; margin-right: 15px; color: #555; }
        .switch { position: relative; display: inline-block; width: 60px; height: 34px; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 34px; }
        .slider:before { position: absolute; content: ""; height: 26px; width: 26px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; }
        input:checked + .slider { background-color: #007bff; }
        input:checked + .slider:before { transform: translateX(26px); }
        
        /* Estilos para las Secciones y Transición */
        #chart-section, #table-section { 
            padding: 20px; 
            border: 1px solid #eee; 
            border-radius: 8px; 
            margin-top: 20px; 
            
            opacity: 0; 
            transform: translateY(20px); 
            transition: opacity 0.5s ease-out, transform 0.5s ease-out; 
            
            /* Cambios de Posicionamiento para evitar que salte el contenedor */
            position: absolute; 
            width: calc(100% - 60px); /* 100% menos el doble del padding (30px*2) */
            top: 190px; 
            left: 30px;
        }

        /* Clase para hacer visible la sección con la transición */
        .active-section {
            opacity: 1 !important;
            transform: translateY(0) !important;
            z-index: 10;
        }

        /* Esto es necesario para que la sección inactiva no tape la activa */
        .inactive-section {
            position: absolute;
            z-index: 1;
        }
        
        .no-data-message {
            padding: 20px;
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 5px;
            text-align: center;
            font-size: 1.1em;
            margin-top: 20px;
        }
        
        /* CORRECCIÓN 2: Posicionamiento del enlace */
        .back-link { 
            display: inline-block; 
            text-decoration: none; 
            color: #007bff; 
            font-weight: bold; 
            position: absolute; /* Usar absolute dentro del .container relativo */
            bottom: 20px; /* Fija el enlace en la parte inferior */
            left: 30px; 
            z-index: 20; /* Asegura que esté por encima de las secciones */
        }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos de Sensores del Aula</h1>

        {{-- Switch de Visualización --}}
        <div class="switch-container">
            <span class="switch-label">Ver Tabla</span>
            <label class="switch">
                <input type="checkbox" id="view-switch">
                <span class="slider round"></span>
            </label>
            <span class="switch-label">Ver Gráfico</span>
			<a href="{{ route('welcome') }}" class="back-link">Volver al Menú Principal</a>
        </div>

        {{-- 1. SECCIÓN DE TABLA --}}
        <div id="table-section" class="active-section">
            <p>Últimos datos registrados, ordenados por fecha y hora:</p>
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
                    @forelse($sensores as $sensor)
                        <tr>
                            <td>{{ $sensor->id }}</td>
                            <td>{{ $sensor->tipo }}</td>
                            <td>{{ $sensor->valor }}</td>
                            <td>{{ $sensor->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">No hay datos de sensores registrados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 2. SECCIÓN DE GRÁFICO --}}
        <div id="chart-section" class="inactive-section" style="display: none;">
            <h2>Gráfico de Temperatura (°C)</h2>
            <div id="chart-placeholder">
                <canvas id="temperatureChart"></canvas>
            </div>
        </div>
        
        {{-- ENLACE DE VUELTA: Ahora posicionado absolutamente al final del contenedor --}}
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewSwitch = document.getElementById('view-switch');
            const tableSection = document.getElementById('table-section');
            const chartSection = document.getElementById('chart-section');
            const chartPlaceholder = document.getElementById('chart-placeholder'); 
            
            // Establece el estado inicial
            tableSection.style.display = 'block'; 
            chartSection.style.display = 'none';

            // Función para cambiar la sección con transición
            function switchSection(showSection, hideSection) {
                // 1. Oculta la sección actual con la animación
                hideSection.classList.remove('active-section');
                hideSection.classList.add('inactive-section');

                // 2. Muestra la nueva sección inmediatamente, pero invisible
                showSection.style.display = 'block';

                // 3. Aplica la clase 'active-section' para que la transición ocurra.
                // Se usa setTimeout para asegurar que el navegador reconozca el cambio de estado.
                setTimeout(() => {
                    showSection.classList.remove('inactive-section');
                    showSection.classList.add('active-section');
                }, 50);

                // 4. Oculta completamente la sección anterior después de que termine la transición (500ms + buffer)
                setTimeout(() => {
                    hideSection.style.display = 'none';
                }, 550); 
            }

            // Lógica para alternar la visibilidad
            viewSwitch.addEventListener('change', function() {
                if (this.checked) {
                    // Muestra Gráfico, Oculta Tabla
                    switchSection(chartSection, tableSection);
                } else {
                    // Muestra Tabla, Oculta Gráfico
                    switchSection(tableSection, chartSection);
                }
            });

            // --- LÓGICA DE CHART.JS ---
            
            const allSensors = @json($sensores->items());
            
            const temperatureReadings = allSensors
                .filter(s => s.tipo === 'temperatura')
                .reverse(); 

            if (temperatureReadings.length === 0) {
                chartPlaceholder.innerHTML = '<div class="no-data-message">⚠️ No hay datos de temperatura para mostrar en el gráfico. Asegúrate de enviar datos con tipo "temperatura".</div>';
                return; 
            }

            const labels = temperatureReadings.map(s => {
                const date = new Date(s.created_at);
                return date.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });
            });
            
            const data = temperatureReadings.map(s => s.valor);

            const ctx = document.getElementById('temperatureChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Temperatura (°C)',
                        data: data,
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderWidth: 2,
                        tension: 0.3, 
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Temperatura (°C)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>