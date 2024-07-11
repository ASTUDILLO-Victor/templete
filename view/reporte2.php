<?php
// Include the required files
require "params/nav.php";

// Conexión a la base de datos
try {
    $pdo = new PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Consulta para obtener los datos del sensor
$sql = "SELECT id, sensor1, sensor2, fecha_actual FROM sensor";
$query = $pdo->prepare($sql);
$query->execute();
$sensor = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gráfico de sensor SDS011 (µg/m3)</title>
    <!-- Incluir Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Incluir chartjs-adapter-date-fns -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2.0.0"></script>
    <!-- Incluir jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <!-- Incluir html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Tu script para cargar los datos y generar gráficos -->
    <script>
        let myChart1;
        let myChart2;

        async function fetchData(chartType, dataUrl) {
            const date = (chartType === 'chart1') ? document.getElementById('dateChart1').value : document.getElementById('dateChart2').value;
            console.log(`Fecha seleccionada para ${chartType}: ${date}`);

            try {
                const response = await fetch(`${dataUrl}?date=${date}`);
                const data = await response.json();

                console.log('Datos recibidos del servidor:', data);

                if (data.error) {
                    alert(data.error);
                    return;
                }

                const timestamps = data.map(entry => entry.fecha_hora);
                const timestamps2 = data.map(entry => entry.hour_start);
                const muestras1 = data.map(entry => parseFloat(entry.valor));
                const muestras2 = data.map(entry => parseFloat(entry.average_sensor2));

                const ctx = (chartType === 'chart1') ? document.getElementById('myChart1').getContext('2d') : document.getElementById('myChart2').getContext('2d');

                // Destruir el gráfico anterior si existe
                if (chartType === 'chart1' && myChart1) {
                    myChart1.destroy();
                }
                if (chartType === 'chart2' && myChart2) {
                    myChart2.destroy();
                }

                if (chartType === 'chart1') {
                    const generateColors = (numOfBars) => {
                        const colors = [];
                        for (let i = 0; i < numOfBars; i++) {
                            // Generar un color aleatorio
                            const r = Math.floor(Math.random() * 255);
                            const g = Math.floor(Math.random() * 255);
                            const b = Math.floor(Math.random() * 255);
                            colors.push(`rgba(${r}, ${g}, ${b}, 0.8)`);
                        }
                        return colors;
                    };

                    const backgroundColors = generateColors(muestras1.length);
                    const borderColors = backgroundColors.map(color => color.replace('1', '1')); // Cambiar la opacidad para el borde

                    myChart1 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: timestamps,
                            datasets: [
                                {
                                    label: 'Partes por millón (ppm)',
                                    data: muestras1,
                                    borderColor: borderColors,
                                    backgroundColor: backgroundColors,
                                    fill: false
                                }
                            ]
                        }
                    });
                } else if (chartType === 'chart2') {
                    const generateColors = (numOfBars) => {
                        const colors = [];
                        for (let i = 0; i < numOfBars; i++) {
                            // Generar un color aleatorio
                            const r = Math.floor(Math.random() * 255);
                            const g = Math.floor(Math.random() * 255);
                            const b = Math.floor(Math.random() * 255);
                            colors.push(`rgba(${r}, ${g}, ${b}, 0.8)`);
                        }
                        return colors;
                    };

                    const backgroundColors = generateColors(muestras2.length);
                    const borderColors = backgroundColors.map(color => color.replace('1', '1')); // Cambiar la opacidad para el borde

                    myChart2 = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: timestamps2,
                            datasets: [
                                {
                                    label: 'Partes por millón (ppm)',
                                    data: muestras2,
                                    borderColor: borderColors,
                                    backgroundColor: backgroundColors,
                                    fill: false
                                }
                            ]
                        }
                    });
                }

            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function exportToPDF(canvasId, pdfFileName) {
        const canvas = document.getElementById(canvasId);
        html2canvas(canvas).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF('landscape');
            const imgWidth = 280; 
            const pageHeight = 210;
            const imgHeight = canvas.height * imgWidth / canvas.width;
            const heightLeft = imgHeight;
            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            pdf.save(pdfFileName);
        });
    }
    </script>

</head>

<body>
    <!--mejorara codigo  -->
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Muestras Diarias de Compuestos Orgánicos Vólatiles(ppm)</h6>
                    <form id="formChart1">
                        <label for="dateChart1">Fecha:</label>
                        <input type="date" id="dateChart1" name="dateChart1" required>
                        <button type="button" class="btn btn-primary" onclick="fetchData('chart1', 'get_data3.php')">Generar</button>
                    </form>
                    <button class="btn btn-secondary" onclick="exportToPDF('myChart1', 'Muestras_Diarias.pdf')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                    </button>
                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart1" width="700" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Illustrations -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-info">Promedio Diario de Compuestos Orgánicos Vólatiles(ppm)</h6>
                    <form id="formChart2">
                        <label for="dateChart2">Fecha:</label>
                        <input type="date" id="dateChart2" name="dateChart2" required>
                        <button type="button" class="btn btn-info" onclick="fetchData('chart2', 'get_data2.php')">Generar</button>
                    </form>
                    <button class="btn btn-secondary" onclick="exportToPDF('myChart2', 'Promedio_Diario.pdf')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                    </svg>
                    </button>

                    <!-- <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myChart2" width="600" height="500"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--fin code-->
        <!-- grafico 2 -->
        <!-- fin grafico 2 -->
</body>

</html>
</script>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>
</body>

</html>