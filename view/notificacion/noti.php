<?php
// Verificar si hay un mensaje para mostrar
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    // Escapar el mensaje para evitar ataques XSS
    $mensaje = htmlspecialchars($mensaje);
    // Mostrar el mensaje utilizando JavaScript para una alerta personalizada que desaparece después de 3 segundos
    echo "<script>
    Swal.fire({
      icon: 'error',
      title: 'Cédula ya registrada',
      text: '$mensaje',
      timer: 5000,
      timerProgressBar: true,
      showConfirmButton: false
    }).then(function() {
        window.location.href = 'index.php?url=tables';
    });
  </script>";
    // echo "<div id='customAlert' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; z-index: 1000;'>" . $mensaje . "</div>";
    // echo "<script>setTimeout(function() { document.getElementById('customAlert').style.display = 'none'; window.location.href = 'index.php?url=tables'; }, 3000);</script>";
}
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Los datos se han insertado correctamente.',
                    timer: 5000,
                    timerProgressBar: true,
                    showConfirmButton: false
                }).then(function() {
                  window.location.href = 'index.php?url=tables';
              });
            });
          </script>";
}
//prueba registro
if (isset($_GET['mensaje1'])) {
  $mensaje = $_GET['mensaje1'];
  // Escapar el mensaje para evitar ataques XSS
  $mensaje = htmlspecialchars($mensaje);
  // Mostrar el mensaje utilizando JavaScript para una alerta personalizada que desaparece después de 3 segundos
  echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Cédula ya registrada',
    text: '$mensaje',
    timer: 5000,
    timerProgressBar: true,
    showConfirmButton: false
  }).then(function() {
      window.location.href = 'index.php?url=tables3';
  });
</script>";
  // echo "<div id='customAlert' style='position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #f8d7da; color: #721c24; padding: 15px; border: 1px solid #f5c6cb; border-radius: 5px; z-index: 1000;'>" . $mensaje . "</div>";
  // echo "<script>setTimeout(function() { document.getElementById('customAlert').style.display = 'none'; window.location.href = 'index.php?url=tables'; }, 3000);</script>";
}
if (isset($_GET['success1']) && $_GET['success1'] == 1) {
  echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Éxito',
                  text: 'Los datos se han insertado correctamente.',
                  timer: 5000,
                  timerProgressBar: true,
                  showConfirmButton: false
              }).then(function() {
                window.location.href = 'index.php?url=tables3';
            });
          });
        </script>";
}
