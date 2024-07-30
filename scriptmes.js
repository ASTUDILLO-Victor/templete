let myChart;
let myBarChart;

document.getElementById('periodo').addEventListener('change', function() {
    const periodo = this.value;
    const mesSeleccion = document.getElementById('mesSeleccion');
    if (periodo === 'diario') {
        mesSeleccion.style.display = 'block';
    } else {
        mesSeleccion.style.display = 'none';
    }
});

function generateChart() {
    const periodo = document.getElementById('periodo').value;
    const mes = document.getElementById('mes').value;

    fetch('fetch_mes.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `periodo=${periodo}&mes=${mes}`
    })
    .then(response => response.json())
    .then(data => {
        if (myChart) {
            myChart.destroy();
        }

        const labels = data.map(item => item.fecha);
        const pm10Data = data.map(item => item.promedio_pm10);
        const pm25Data = data.map(item => item.promedio_pm25);

        const datasets = [
            {
                label: 'PM10 (µg/m3)',
                data: pm10Data,
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            },
            {
                label: 'PM2.5 (µg/m3)',
                data: pm25Data,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: false
            }
        ];

        const ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: periodo === 'diario' ? 'line' : 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Destruir la instancia existente de DataTable si existe
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            $('#dataTable').DataTable().clear().destroy();
        }

        // Configurar las columnas de la tabla
        let columns = [];
        if (periodo === 'diario') {
            columns = [
                { title: "Fecha", data: 'fecha' },
                { title: "Promedio PM10", data: 'promedio_pm10' },
                { title: "Promedio PM2.5", data: 'promedio_pm25' },
                { title: "Estado de concentración", data: 'estado' },
                { title: "Actuador en Operación", data: function(row) {
                    return row.estado === 'Elevado' ? 'Encendido' : 'Apagado';
                }
            }                  

            ];
        } else if (periodo === 'mensual') {
            columns = [
                { title: "Fecha", data: 'fecha' },
                { title: "Promedio PM10", data: 'promedio_pm10' },
                { title: "Promedio PM2.5", data: 'promedio_pm25' },
                { title: "Promedio PM2.5", data: 'promedio_pm25', visible: false },
                { title: "Estado", data: function(row) {
                                 return row.promedio_pm10 > 100 || row.promedio_pm25 > 50 ? 'Elevado' : 'No Elevado';
                             }
                         }
            ];
        }
        // const columns = [
        //     { title: "Fecha", data: 'fecha' },
        //     { title: "Promedio PM10", data: 'promedio_pm10' },
        //     { title: "Promedio PM2.5", data: 'promedio_pm25' },
        //     { title: "Estado", data: function(row) {
        //             return row.promedio_pm10 > 100 || row.promedio_pm25 > 50 ? 'Elevado' : 'No Elevado';
        //         }
        //     }
        // ];

        // Inicializar DataTable con los datos obtenidos
        $('#dataTable').DataTable({
            data: data,
            columns: columns,
            destroy: true,
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
    })
    .catch(error => console.error('Error:', error));
}

document.getElementById('downloadPDF').addEventListener('click', () => {
    if (!myChart) {
        Swal.fire({
            icon: 'warning',
            title: 'Gráfico no generado',
            text: 'Por favor, genera un gráfico antes de intentar descargar el PDF.'
        });
        return;
    }
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    doc.text('Reporte de Partículas Suspendidas en el Aire', 14, 16);

    const chartCanvas = document.getElementById('myChart');
    const chartImgData = chartCanvas.toDataURL('image/png');
    doc.addImage(chartImgData, 'PNG', 10, 20, 180, 100);

    doc.autoTable({
        html: '#dataTable',
        startY: 130
    });

    doc.save('reporte_concentraciones.pdf');
});
