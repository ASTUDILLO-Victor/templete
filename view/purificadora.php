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
</head>
<body>
<div class="container">
    <h3>ESTADO DE MÁQUINA PURIFICADORA</h3>
    <div id="statusIndicator" class="status-indicator status-off">OFF</div>
    <label class="switch">
        <input type="checkbox" id="relayToggle">
        <span class="slider round"></span>
    </label>
    
</div>  
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registros</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="relayTable" width="100%" cellspacing="0">
                    <!-- DataTable -->
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- Data will be inserted here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<!-- <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Notificación</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body"></div>
</div> -->

<script>
    const proxyURL = 'register.php'; // URL para guardar el estado en la base de datos

document.getElementById('relayToggle').addEventListener('change', function() {
    const action = this.checked ? 'on' : 'off';
    fetch(`${proxyURL}?action=${action}`)
        .then(response => response.text())
        .then(data => {
            console.log('Respuesta del servidor:', data); // Agrega este log
            if (data.includes(`already ${action.toUpperCase()}`)) {
                showToast(`La máquina ya está ${action === 'on' ? 'encendida' : 'apagada'}.`);
            }
            updateStatusIndicator(action);
        })
        .catch(error => {
            showToast('No se pudo conectar al servidor.');
            console.error('Error:', error);
        });
});

    function showToast(message) {
        var toast = $('#toast');
        toast.find('.toast-body').text(message);
        toast.toast({ delay: 5000 });
        toast.toast('show');
    }

    function checkForNewRecords() {
        $.ajax({
            type: 'GET',
            url: 'fetch_latest.php',
            dataType: 'json',
            success: function(data) {
                if (data.status === 'success') {
                    let record = data.data;
                    if (typeof lastRecordId === 'undefined' || record.id !== lastRecordId) {
                        lastRecordId = record.id;
                        updateStatusIndicator(record.action);
                        document.getElementById('relayToggle').checked = (record.action === 'on');
                        showToast(`Estado: ${record.action === 'on' ? 'Encendido' : 'Apagado'} - Descripción: ${record.descripcion} - Hora: ${record.timestamp}`);
                    }
                } else {
                    console.error('Error en los datos:', data.message);
                }
            },
            error: function() {
                console.error('Error en la comunicación con el servidor');
            }
        });
    }

    function updateStatusIndicator(action) {
        const indicator = document.getElementById('statusIndicator');
        if (action === 'on') {
            indicator.classList.remove('status-off');
            indicator.classList.add('status-on');
            indicator.innerText = 'ON';
        } else {
            indicator.classList.remove('status-on');
            indicator.classList.add('status-off');
            indicator.innerText = 'OFF';
        }
    }
    
    let lastRecordId;

    $(document).ready(function() {
        // Verificar nuevos registros cada 5 segundos
        setInterval(checkForNewRecords, 1000);
    });

    $(document).on('click', '.toast .close', function() {
        $(this).closest('.toast').toast('hide');
    });
    $(document).ready(function() {
        // Inicializar DataTable
        const table = $('#relayTable').DataTable({
            "order": [[0, 'desc']], // Ordenar por la columna de fecha de forma descendente
            "paging": true,
            "searching": true,
            "info": true,
            "language": {
                "emptyTable": "No hay datos disponibles",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron resultados"
            }
        });

        // Función para cargar datos
        function loadTableData() {
            $.ajax({
                type: 'GET',
                url: 'estado_rele.php',
                dataType: 'json',
                success: function(response) {
                    const allData = response.allData;
                    table.clear(); // Limpiar tabla antes de insertar nuevos datos
                    allData.forEach(row => {
                        table.row.add([
                            row.timestamp,  // Fecha
                            row.action === 'on' ? 'Encendido' : 'Apagado',  // Estado
                            row.descripcion // Descripción
                        ]).draw(false);
                    });
                },
                error: function() {
                    console.error('Error en la comunicación con el servidor');
                }
            });
        }

        // Cargar datos al inicio
        loadTableData();

        // Verificar nuevos registros cada 1 segundo
       setInterval(loadTableData, 3000);
    });

</script>
</body>
</html>
