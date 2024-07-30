let myChart;
let myBarChart;

function generateChart() {
    const table = document.getElementById('table').value;
    const date = document.getElementById('date').value;
    const hour = document.getElementById('hour').value;
    if (!date) {
        Swal.fire({
            icon: 'warning',
            title: 'Fecha no seleccionada',
            text: 'Por favor, selecciona una fecha.'
        });
        return;
    }

    fetch('fetch_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `table=${table}&date=${date}&hour=${hour}`
    })
    .then(response => response.json())
    .then(data => {
        if (myChart) {
            myChart.destroy();
        }

        const downsampleFactor = 10;
        const labels = data.map(item => item.date);
        const downsampledLabels = downsample(labels, downsampleFactor);

        let datasets = [];

        if (table === 'lectura_sds011') {
            const pmdiez = data.map(item => item.pm10);
            const pmdoscinco = data.map(item => item.pm25);

            const downsampledpmdiez = downsample(pmdiez, downsampleFactor);
            const downsampledpmdoscinco = downsample(pmdoscinco, downsampleFactor);

            datasets = [
                {
                    label: 'PM 10',
                    data: pmdiez,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'PM 2.5',
                    data: pmdoscinco,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ];
        } else if (table === 'lectura_mq138') {
            const values = data.map(item => item.value);
            const downsampledValues = downsample(values, downsampleFactor);

            datasets = [
                {
                    label: 'PPM',
                    data: values,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ];
        }

        const ctx = document.getElementById('myChart').getContext('2d');
        myChart = new Chart(ctx, {
            type: 'line',
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
                },
                plugins: {
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'xy'
                        },
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'xy',
                        }
                    }
                }
            }
        });

        fetch('fetch_prom_data.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `table=${table}&date=${date}`
        })
        .then(response => response.json())
        .then(data => {
            let columns = [];
            if (table === 'lectura_sds011') {
                columns = [
                    { title: "Hora de Inicio", data: 'hora_inicio' },
                    { title: "Promedio PM10", data: 'prom_pm10' },
                    { title: "Promedio PM2.5", data: 'prom_pm25' },
                    { title: "Estado", data: 'estado' }                  
                ];
            } else if (table === 'lectura_mq138') {
                columns = [
                    { title: "Hora de Inicio", data: 'hora_inicio' },
                    { title: "Promedio Valor", data: 'prom_valor' },
                    { title: "Estado", data: 'estado' },
                    { title: "ID", data: 'id_pro', visible: false },
                ];
            }

            $('#dataTable').DataTable({
                destroy: true,
                data: data,
                columns: columns,
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

            if (myBarChart) {
                myBarChart.destroy();
            }

            const barLabels = data.map(item => item.hora_inicio);
            let barDataSets = [];

            if (table === 'lectura_sds011') {
                const promPm10 = data.map(item => item.prom_pm10);
                const promPm25 = data.map(item => item.prom_pm25);

                barDataSets = [
                    {
                        label: 'Promedio PM10',
                        data: promPm10,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Promedio PM2.5',
                        data: promPm25,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ];
            } else if (table === 'lectura_mq138') {
                const promValor = data.map(item => item.prom_valor);

                barDataSets = [
                    {
                        label: 'Promedio Valor',
                        data: promValor,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }
                ];
            }

            const barCtx = document.getElementById('myBarChart').getContext('2d');
            myBarChart = new Chart(barCtx, {
                type: 'line',
                data: {
                    labels: barLabels,
                    datasets: barDataSets
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
        })
        .catch(error => console.error('Error:', error));
    })
    .catch(error => console.error('Error:', error));
}

function downsample(data, factor) {
    return data.filter((_, index) => index % factor === 0);
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
    const table = document.getElementById('table').value;
    const date = document.getElementById('date').value;
    const hour = document.getElementById('hour').value;
    let nombre = '';
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    if (table === 'lectura_sds011') {
        nombre = 'Partículas Suspendidas en el Aire';
    } else{
        nombre = 'Compuestos Orgánicos Volatiles';
    }
    doc.text(`Reporte de ${nombre}`, 14, 16);

    const chartCanvas = document.getElementById('myChart');
    const chartImgData = chartCanvas.toDataURL('image/png');
    doc.addImage(chartImgData, 'PNG', 10, 20, 180, 100);

    doc.text(`Promedio: ${date}`, 14, 129);
    
    const barChartCanvas = document.getElementById('myBarChart');
    const barChartImgData = barChartCanvas.toDataURL('image/png');
    doc.addImage(barChartImgData, 'PNG', 10, 130, 180, 100);

    const tableElement = document.getElementById('dataTable');
    doc.autoTable({ html: tableElement, startY: 240 });

    doc.save(`${table}_${date}_${hour}.pdf`);
});
