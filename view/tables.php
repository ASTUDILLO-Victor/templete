<?php
// Include the required files
require "params/nav.php";
require "modal/modal.php";


// Function to get role name from id_rol
// function getRoleName($id_rol) {
//     // You can replace this with your actual method to fetch role names
//     $roles = [
//         1 => 'SuperAdmin',
//         2 => 'Admin',
//         3 => 'Usuario',
//         // Add all roles as needed
//     ];
//     return $roles[$id_rol] ?? 'Unknown';
// }
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
        <div class="card-header py-3 hola">
            <h1 class="m-0 font-weight-bold text-primary">Usuarios</h1>
            
            <a href="index.php?url=registro" class="btn btn-info text-End">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                    <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0" />
                </svg>&nbsp;Nuevo
            </a>
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
                            <th>Desactivar</th>
                            <th>Actualizar</th>
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
                            <th>Desactivar</th>
                            <th>Actualizar</th>
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
                                <td><?= htmlspecialchars($user->sexo) ?></td>
                                <td><?= htmlspecialchars($user->celu) ?></td>
                                <td><?= htmlspecialchars($edad ) ?></td>
                                <td><?= htmlspecialchars($user->dire) ?></td>
                                
                                <td>
                                    <form id="deleteForm<?= htmlspecialchars($user->id_e) ?>" action="index.php?url=eliminar" method="post">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($user->id_e) ?>">
                                        <button class="btn btn-danger" type="button" onclick="confirmDeletion(<?= htmlspecialchars($user->id_e) ?>)">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button data-action="editar"
                                        onclick="aparezcaModal(<?= htmlspecialchars($user->id_e) ?>,'<?= htmlspecialchars($user->cedula) ?>', '<?= htmlspecialchars($user->name) ?>','<?= htmlspecialchars($user->ape) ?>','<?= htmlspecialchars($user->email) ?>','<?= htmlspecialchars($user->nombre) ?>','<?= htmlspecialchars($user->sexo) ?>','<?= htmlspecialchars($user->celu) ?>','<?= htmlspecialchars($user->fecha) ?>','<?= htmlspecialchars($user->dire) ?>')"
                                        class="btn btn-success" type="submit">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                        </svg>
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
<div class="alert" id="alert">
  Los datos se han insertado correctamente.
</div>

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

</body>

</html>
<?= require "notificacion/noti.php" ?>
