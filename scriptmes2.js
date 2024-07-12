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

    fetch('fetch_mes2.php', {
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
        const valorData = data.map(item => item.promedio_valor);
        //const pm25Data = data.map(item => item.promedio_pm25);

        const datasets = [
            {
                label: 'COV (ppm)',
                data: valorData,
                borderColor: 'rgba(255, 99, 132, 1)',
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

        // Actualizar la tabla
        const tableHead = document.getElementById('tableHead');
        tableHead.innerHTML = `
            <tr>
                <th>Fecha</th>
                <th>Promedio COV</th>
                <th>Estado</th>
            </tr>
        `;

        const tableBody = document.querySelector('#dataTable tbody');
        tableBody.innerHTML = '';
        data.forEach(row => {
            const estado = row.promedio_valor > 200 ? 'Elevado' : 'No Elevado';
            tableBody.innerHTML += `
                <tr>
                    <td>${row.fecha}</td>
                    <td>${row.promedio_valor}</td>
                    
                    <td>${estado}</td>
                </tr>
            `;
        });

        $('#dataTable').DataTable();
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

    doc.text('Reporte Reporte de Compuestos Orgánicos Volátiles', 14, 16);

    const chartCanvas = document.getElementById('myChart');
    const chartImgData = chartCanvas.toDataURL('image/png');
    doc.addImage(chartImgData, 'PNG', 10, 20, 180, 100);

    doc.autoTable({
        html: '#dataTable',
        startY: 130
    });

    doc.save('reporte_concentraciones.pdf');
});
