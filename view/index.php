<?php require "params/nav.php" ?>
<!-- Begin Page Content -->
<style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: 20px;
        }
        .status-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100px;
            height: 100px;
            border: 10px solid grey;
            border-radius: 50%;
            text-align: center;
            line-height: 1.5;
            font-size: 24px;
            color: grey;
            margin-bottom: 20px;
        }
        .status-on {
            border-color: green;
            color: green;
        }
        .status-off {
            border-color: red;
            color: red;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        .switch input {
            display: none;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
        /* Notification toast */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
        }
    </style>
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- Content Row -->
    <div class="row">
            <!-- PM10 Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    PM10 (ug/m3)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="pm10-value">Cargando...</div>
                                <div class="text-xs mt-2" id="pm10-date">Fecha: Cargando...</div>
                            </div>
                            <div class="col-auto">
                            <a class="nav-link" href="index.php?url=reporte_uno">
                                <i class="fa fa-clipboard"></i>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PM2.5 Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    PM 2.5 (ug/m3)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="pm25-value">Cargando...</div>
                                <div class="text-xs mt-2" id="pm25-date">Fecha: Cargando...</div>
                            </div>
                            <div class="col-auto">
                            <a class="nav-link" href="index.php?url=reporte_uno">
                                <i class="fa fa-clipboard"></i>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PPM Card -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    COV (ppm)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="ppm-value">Cargando...</div>
                                <div class="text-xs mt-2" id="ppm-date">Fecha: Cargando...</div>
                            </div>
                            <a class="nav-link" href="index.php?url=reporte2">
                                <i class="fa fa-clipboard"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Promedio</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="barChart" ></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a class="nav-link" href="index.php?url=purificadora">
                        <i class="fa fa-toggle-off"></i>
                        <span>Estado</span>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div id="statusIndicator" class="status-indicator status-off">OFF</div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>
<script>
        function fetchRelayState() {
            $.ajax({
                url: 'get_relay_state.php',
                method: 'GET',
                success: function(data) {
                    var statusIndicator = $('#statusIndicator');
                    if (data.trim() === 'on') {
                        statusIndicator.text('ON');
                        statusIndicator.removeClass('status-off').addClass('status-on');
                    } else {
                        statusIndicator.text('OFF');
                        statusIndicator.removeClass('status-on').addClass('status-off');
                    }
                },
                error: function() {
                    console.log('Error al obtener el estado del relé');
                }
            });
        }

        $(document).ready(function() {
            fetchRelayState();
            // Opcional: Actualizar cada cierto tiempo
            setInterval(fetchRelayState, 3000); // Actualizar cada 5 segundos
        });
        $(document).ready(function() {
            $.ajax({
                url: 'diario.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Actualizar los valores en los card elements
                    $('#pm10-value').text(data.sds011.promedio_pm10);
                    $('#pm10-date').text('Fecha: ' + data.sds011.fecha);

                    $('#pm25-value').text(data.sds011.promedio_pm25);
                    $('#pm25-date').text('Fecha: ' + data.sds011.fecha);

                    $('#ppm-value').text(data.mq138.promedio_valor);
                    $('#ppm-date').text('Fecha: ' + data.mq138.fecha);
                },
                error: function() {
                    console.log('Error al obtener los datos.');
                }
            });
        });
        $(document).ready(function() {
        $.ajax({
            url: 'diario.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // Datos para el gráfico de barras
                const labels = ['Concentraciones'];
                const pm10Data = [data.sds011.promedio_pm10];
                const pm25Data = [data.sds011.promedio_pm25];
                const ppmData = [data.mq138.promedio_valor];

                // Crear el gráfico de barras
                const ctx = document.getElementById('barChart').getContext('2d');
                const barChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'PM10',
                                data: pm10Data,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'PM2.5',
                                data: pm25Data,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'PPM',
                                data: ppmData,
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    min: 0
                                }
                            }]
                        }
                    }
                });
            },
            error: function() {
                console.log('Error al obtener los datos.');
            }
        });
    });

    </script>
</html>