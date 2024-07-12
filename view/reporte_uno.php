<?php
// Include the required files
require "params/nav.php";
include 'conexion.php';

// Consulta para obtener los meses disponibles en la base de datos
$sql_meses = "SELECT DISTINCT DATE_FORMAT(hora_inicio, '%Y-%m') as mes FROM prom_sds011 ORDER BY mes";
$result_meses = $conn->query($sql_meses);

$meses = [];
if ($result_meses->num_rows > 0) {
    while($row = $result_meses->fetch_assoc()) {
        $meses[] = $row['mes'];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Gráfico</title>
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
    <style>
        .form-inline .form-group {
            display: flex;
            align-items: center;
            margin-right: 15px;
        }
        #mesSeleccion {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
        <h1 class="mt-4">Reporte de Partículas Suspendidas en el Aire</h1>
        <form id="dataForm" class="form-inline">
            <div class="form-group mb-2">
                <label for="periodo" class="mr-2">Periodo:</label>
                <select id="periodo" name="periodo" class="form-control">
                    <option value="mensual">Mensual</option>
                    <option value="diario">Diario</option>
                </select>
            </div>
            <div class="form-group mb-2" id="mesSeleccion">
                <label for="mes" class="mr-2">Mes:</label>
                <select id="mes" name="mes" class="form-control">
                    <?php foreach ($meses as $mes): ?>
                        <option value="<?= $mes ?>"><?= $mes ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary mb-2" onclick="generateChart()">Generar</button>
            <button type="button" id="downloadPDF" class="btn btn-secondary mb-2 ml-2">Descargar PDF</button>
        </form>
        <canvas id="myChart" width="400" height="200" class="mt-4"></canvas>
        <div class="table-responsive mt-4">
            <table id="dataTable" class="display table table-striped table-bordered" style="width:100%">
                <thead id="tableHead"></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <script src="scriptmes.js"></script>
    <script>
        document.getElementById('periodo').addEventListener('change', function() {
            const mesSeleccion = document.getElementById('mesSeleccion');
            if (this.value === 'diario') {
                mesSeleccion.style.display = 'flex';
            } else {
                mesSeleccion.style.display = 'none';
            }
        });
    </script>
</body>
</html>
