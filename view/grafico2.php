<?php
// Include the required files
require "params/nav.php";
// Conexión a la base de datos

?>

<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
  <meta charset="utf-8">
  <title>Real-Time Line Chart</title>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  
</head>

<body style="height: 100%; margin: 0">
  <div class="row">
      <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Monitoreo de Compuestos Orgánicos Vólatiles(ppm)</h6>
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
                      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 18rem;" src="img/grafico-de-linea.gif" alt="...">
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
                        <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>ppm</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>ppm</th>
                        </tr>
                        </tfoot>
                        <tbody id="dataBody">
                        <tr>
                            <td colspan="2">Cargando datos...</td>
                        </tr>
                        </tbody>
                    </table>
                  </div>
              </div>
          </div>
      </div>

    <script type="text/javascript">
    const ctx = document.getElementById('myLineChart').getContext('2d');
    const myLineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [],
        datasets: [{
          label: 'ppm',
          data: [],
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          fill: true,
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    let dataTable;

    function updateData() {
      $.ajax({
        url: "recoger.php",
        dataType: 'json',
        success: function(response) {
          // Actualizar tabla con todos los datos
          var tableData = [];
          response.allData.forEach(function(item) {
            tableData.push([item.fecha_hora, item.valor]);
          });

          // Si DataTable está inicializado, actualizar datos
          if (dataTable) {
            dataTable.clear();
            dataTable.rows.add(tableData);
            dataTable.draw();
          } else {
            // Inicializar DataTable
            dataTable = $('#dataTable').DataTable({
              data: tableData,
              columns: [
                { title: "Fecha" },
                { title: "ppm" }
              ]
            });
          }

          // Actualizar gráfico con el último dato
          const lastItem = response.lastData;

          if (!myLineChart.data.labels.includes(lastItem.fecha_hora)) {
            myLineChart.data.labels.push(lastItem.fecha_hora);
            myLineChart.data.datasets[0].data.push(lastItem.valor);
            myLineChart.update();
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.error("Error al obtener los datos: ", textStatus, errorThrown);
        }
      });
    }

    // Primera actualización después de 1 segundo
    setTimeout(function() {
      // Inicialización con solo el último dato
      $.ajax({
        url: "recoger.php",
        dataType: 'json',
        success: function(response) {
          // Mostrar solo el último dato inicialmente
          const lastItem = response.lastData;
          myLineChart.data.labels = [lastItem.fecha_hora];
          myLineChart.data.datasets[0].data = [lastItem.valor];
          myLineChart.update();

          // Actualizar tabla con todos los datos
          var tableData = [];
          response.allData.forEach(function(item) {
            tableData.push([item.fecha_hora, item.valor]);
          });

          // Inicializar DataTable
          dataTable = $('#dataTable').DataTable({
            data: tableData,
            columns: [
              { title: "Fecha" },
              { title: "ppm" }
            ],
            order: [[0, 'desc']],
            language: {
              "decimal": "",
              "emptyTable": "No hay datos disponibles en la tabla",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
              "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
              "infoFiltered": "(filtrado de _MAX_ entradas totales)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "No se encontraron registros coincidentes",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
              "aria": {
                "sortAscending": ": activar para ordenar la columna de manera ascendente",
                "sortDescending": ": activar para ordenar la columna de manera descendente"
              }
            }
          });
        }
      });

      // Actualizaciones posteriores cada 10 segundos
      setInterval(updateData, 10000);
    }, 1000);
  </script>

  
  </body>
</html>