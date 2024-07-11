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

// Verificar el parámetro q
if (isset($_GET['q'])) {
  $queryType = $_GET['q'];

  if ($queryType == 1) {
      // Consulta para el gráfico
      $sql = "SELECT sensor1 FROM sensor ORDER BY fecha_actual DESC LIMIT 1";
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      echo json_encode($result);
      exit;
  } else if ($queryType == 2) {
      // Consulta para la tabla
      $sql = "SELECT id, sensor1, sensor2, fecha_actual FROM sensor ORDER BY fecha_actual DESC";
      $query = $pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchAll(PDO::FETCH_ASSOC);
      echo json_encode($result);
      exit;
  } else if ($queryType == 3 && isset($_GET['last_id'])) {
      // Verificación de nuevos registros
      $lastId = $_GET['last_id'];
      $sql = "SELECT COUNT(*) AS new_records FROM sensor WHERE id > :last_id";
      $query = $pdo->prepare($sql);
      $query->bindParam(':last_id', $lastId, PDO::PARAM_INT);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_ASSOC);
      echo json_encode($result);
      exit;
  }
}

// Consulta inicial para cargar la página
$sql = "SELECT id, sensor1, sensor2, fecha_actual FROM sensor ORDER BY fecha_actual DESC";
$query = $pdo->prepare($sql);
$query->execute();
$sensor = $query->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
  <meta charset="utf-8">
  <title>Real-Time Line Chart</title>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body style="height: 100%; margin: 0">
  <div class="row">
      <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monitoreo de Partículas Suspendidas en el Aire(µg/m3)</h6>
                  <!-- <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                          <div class="dropdown-header">Dropdown Header:</div>
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                  </div> -->
              </div>
              <div class="card-body">
                  <div class="chart-area">
                      <canvas id="myLineChart" width="800" height="350"></canvas>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
              </div>
              <div class="card-body">
                  <div class="text-center">
                      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15.5rem;" src="img/undraw_predictive_analytics_re_wxt8.svg" alt="...">
                  </div>
                  <p>Gráfico para visualizar la toma de datos mediante los sensores</p>
              </div>
          </div>
      </div>

      <div class="container-fluid">
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Muestras Diarias</h6>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead class="bg-primary text-white">
                              <tr>
                                  <th>Fecha</th>
                                  <th>PM10 (µg/m3)</th>
                                  <th>PM2.5 (µg/m3)</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Fecha</th>
                                  <th>PM10 (µg/m3)</th>
                                  <th>PM2.5 (µg/m3)</th>
                              </tr>
                          </tfoot>
                          <tbody id="tabla-datos">
                              <?php if (!empty($sensor)): ?>
                                  <?php foreach ($sensor as $datos): ?>
                                      <tr>
                                          <td><?= htmlspecialchars($datos->fecha_actual) ?></td>
                                          <td><?= htmlspecialchars($datos->sensor1) ?></td>
                                          <td><?= htmlspecialchars($datos->sensor2) ?></td>

                                      </tr>
                                  <?php endforeach ?>
                              <?php else: ?>
                                  <tr>
                                      <td colspan="2">No hay datos disponibles</td>
                                  </tr>
                              <?php endif ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

      <script type="text/javascript">
    let lastId = <?= end($sensor)->id ?? 0 ?>;

    const ctx = document.getElementById('myLineChart').getContext('2d');
    const myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [
                {
                    label: 'PM10 (µg/m3)',
                    data: [],
                    borderColor: 'rgba(75, 192, 22, 1)',
                    //backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                },
                {
                    label: 'PM 2.5 (µg/m3)',
                    data: [],
                    borderColor: 'rgba(192, 75, 22, 1)',
                    
                    //backgroundColor: 'rgba(192, 75, 22, 0.2)',
                    fill: true,
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    function updateChart() {
        $.ajax({
            url: "http://localhost/templete-main/recoger.php?q=1",
            dataType: 'json',
            success: function(response) {
                var newValue1 = response[0].sensor1;
                var newValue2 = response[0].sensor2;
                var newLabel = new Date().toLocaleTimeString();

                myLineChart.data.labels.push(newLabel);
                myLineChart.data.datasets[0].data.push(newValue1);
                myLineChart.data.datasets[1].data.push(newValue2);

                if (myLineChart.data.labels.length > 20) {
                    myLineChart.data.labels.shift();
                    myLineChart.data.datasets[0].data.shift();
                    myLineChart.data.datasets[1].data.shift();
                }

                myLineChart.update();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al obtener los datos: ", textStatus, errorThrown);
            }
        });
    }

    function checkNewData() {
        $.ajax({
            url: "?q=3&last_id=" + lastId,
            dataType: 'json',
            success: function(response) {
                if (response.new_records > 0) {
                    updateChart();
                    updateTable();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al verificar nuevos datos: ", textStatus, errorThrown);
            }
        });
    }

    function updateTable() {
        $.ajax({
            url: "?q=2",
            dataType: 'json',
            success: function(response) {
                var tbody = $('#tabla-datos');
                tbody.empty();
                response.forEach(function(data) {
                    tbody.append('<tr><td>' + data.fecha_actual + '</td><td>' + data.sensor1 + '</td><td>' + data.sensor2 + '</td></tr>');
                });

                if (response.length > 0) {
                    lastId = response[0].id; // Actualiza el último ID
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al obtener los datos: ", textStatus, errorThrown);
            }
        });
    }

    // Primera verificación después de 1 segundo
    setTimeout(function () {
        checkNewData();
        updateChart();

        // Verificaciones posteriores cada 10 segundos
        setInterval(checkNewData, 10000);
        setInterval(updateChart, 10000);
    }, 1000);
</script>

      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
      <script src="js/sb-admin-2.min.js"></script>
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
      <script src="js/demo/datatables-demo.js"></script>
  </body>
</html>