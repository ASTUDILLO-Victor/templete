<?php
// Include the required files
require "params/nav.php";
require "modal/modal.php";
?>

<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Usuarios</h1>
        <a href="index.php?url=registro" class="btn btn-info">
            <i class="fas fa-file-earmark-plus-fill"></i> Nuevo
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h1 class="m-0 font-weight-bold text-primary">Usuarios</h1>
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
                            <th>Desactivar</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                            <th>Desactivar</th>
                            <th>Editar</th>
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
                                <td><?= htmlspecialchars($user->cedula) ?></td>
                                <td><?= htmlspecialchars($user->name) ?></td>
                                <td><?= htmlspecialchars($user->ape) ?></td>
                                <td><?= htmlspecialchars($user->email) ?></td>
                                <td><?= htmlspecialchars($user->nombre) ?></td>
                                <td>
                                    <form id="deleteForm<?= htmlspecialchars($user->id_e) ?>" action="index.php?url=eliminar" method="post">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id_e) ?>">
                                        <button class="btn btn-danger" type="button" onclick="confirmDeletion(<?= htmlspecialchars($user->id_e) ?>)">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button data-action="editar"
                                        onclick="aparezcaModal(<?= htmlspecialchars($user->id_e) ?>,'<?= htmlspecialchars($user->cedula) ?>', '<?= htmlspecialchars($user->name) ?>','<?= htmlspecialchars($user->ape) ?>','<?= htmlspecialchars($user->email) ?>','<?= htmlspecialchars($user->id_rol) ?>','<?= htmlspecialchars($user->sexo) ?>','<?= htmlspecialchars($user->celu) ?>','<?= htmlspecialchars($user->fecha) ?>','<?= htmlspecialchars($user->dire) ?>')"
                                        class="btn btn-success">
                                        <i class="fas fa-clipboard-plus-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Contenedor de la alerta -->
    <div class="alert" id="alert"></div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
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

</body>

</html>
<?= require "notificacion/noti.php" ?>
