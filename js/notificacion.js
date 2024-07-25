$(document).ready(function() {
    let lastTimestamp = null;

    function fetchLastLog() {
        $.ajax({
            url: 'get_last_log.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data && data.timestamp !== lastTimestamp) {
                    lastTimestamp = data.timestamp;
                    let action = data.action === 'on' ? 'Encendido' : 'Apagado';
                    let description = data.descripcion;
                    let timestamp = data.timestamp;
                    showToast(action, description, timestamp);
                }
            }
        });
    }

    function showToast(action, description, timestamp) {
        const toastHtml = `
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                <div class="toast-header">
                    <strong class="me-auto">Notificación</strong>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                </div>
                
                <div class="toast-body">
                    <p>Estado: ${action} - Descripción: ${description}</p>
                    <p>Hora: ${timestamp}</p>
                </div>
            </div>`;
        $('#toast-container').html(toastHtml); // Reemplazar contenido anterior
        $('.toast').toast('show');
        $(document).on('click', '.toast .close', function() {
            $(this).closest('.toast').toast('hide');
        });
    }

    // Check for new log every 3 seconds
    setInterval(fetchLastLog, 3000);
});