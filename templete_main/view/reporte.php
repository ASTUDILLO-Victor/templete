<?php
// Include the required files
require "params/nav.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Gráfico</title>
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
        <h1 class="mt-4">Reporte de Concentraciones </h1>
        <form id="dataForm" class="form-inline">
            <div class="form-group mb-2">
                <label for="table" class="mr-2">Concetración:</label>
                <select id="table" name="table" class="form-control mr-4">
                    <option value="lectura_sds011">Particulas Suspendidas en el Aire</option>
                    <option value="lectura_mq138">Compuestos Orgánicos Vólatiles</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="date" class="mr-2">Fecha:</label>
                <input type="date" id="date" name="date" class="form-control mr-4">
            </div>
            <div class="form-group mb-2">
                <label for="hour" class="mr-2">Hora:</label>
                <select id="hour" name="hour" class="form-control mr-4">
                    <option value="all">Todo el día</option>
                    <option value="00:00:00">00:00</option>
                    <option value="01:00:00">01:00</option>
                    <option value="02:00:00">02:00</option>
                    <option value="03:00:00">03:00</option>
                    <option value="04:00:00">04:00</option>
                    <option value="05:00:00">05:00</option>
                    <option value="06:00:00">06:00</option>
                    <option value="07:00:00">07:00</option>
                    <option value="08:00:00">08:00</option>
                    <option value="09:00:00">09:00</option>
                    <option value="10:00:00">10:00</option>
                    <option value="11:00:00">11:00</option>
                    <option value="12:00:00">12:00</option>
                    <option value="13:00:00">13:00</option>
                    <option value="14:00:00">14:00</option>
                    <option value="15:00:00">15:00</option>
                    <option value="16:00:00">16:00</option>
                    <option value="17:00:00">17:00</option>
                    <option value="18:00:00">18:00</option>
                    <option value="19:00:00">19:00</option>
                    <option value="20:00:00">20:00</option>
                    <option value="21:00:00">21:00</option>
                    <option value="22:00:00">22:00</option>
                    <option value="23:00:00">23:00</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary mb-2" onclick="generateChart()">Generar</button>
            <button type="button" id="downloadPDF" class="btn btn-secondary mb-2 ml-2"> Descargar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                  </svg>
            </button>
        </form>
        <h1>Muestras Diarias</h1>
        <canvas id="myChart" width="400" height="200" class="mt-4"></canvas>
        <h1>Promedios Diarios</h1>
        <canvas id="myBarChart" width="200" height="100" class="mt-4"></canvas>
        <div class="table-responsive mt-4">
            <table id="dataTable" class="display table table-striped table-bordered" style="width:100%">
                <thead id="tableHead"></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="scriptprom.js"></script>
</body>
</html>
