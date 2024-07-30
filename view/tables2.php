<?php require "params/nav.php";
require "modal/modal.php";


?>

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!--<h1 class="h3 mb-2 text-gray-800">Usuarios</h1>-->
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 hola ">
            <h1 class="m-0 font-weight-bold text-primary">Usuarios Desactivados </h1>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Edad</th>
                            <th>Dirección</th>
                            <th>Activar</th>
                            
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Edad</th>
                            <th>Dirección</th>
                            <th>Activar</th>
                            
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($todo as $user): 
                            $fecha_nacimiento = $user->fecha;
                            $fecha_nacimiento_obj = new DateTime($fecha_nacimiento);
                            $fecha_actual = new DateTime();
                            $edad = $fecha_actual->diff($fecha_nacimiento_obj)->y;
                            
                            
                            ?>
                            <tr>
                                <td><?= $user->cedula ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->ape ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->nombre ?></td>
                                <td><?= $user->sexo ?></td>
                                <td><?= $user->celu ?></td>
                                <td><?= $edad ?></td>
                                <td><?= $user->dire ?></td>
                                                            
                                <!-- Código específico para usuarios -->
                                <td>
                                    <form id="activarForm<?= $user->id_e ?>" action="index.php?url=eliminar2" method="post">
                                        <input type="hidden" name="id" value="<?= $user->id_e ?>">
                                        <button class="btn btn-primary" type="button" onclick="confirmActivar(<?= $user->id_e ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
  <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
  <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
</svg>
                                        </button>
                                    </form>
                                </td>
                               
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
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
        });
</script>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->


<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>


</body>

</html>
<?= require "notificacion/noti.php" ?>