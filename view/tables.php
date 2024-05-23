<?= require "params/nav.php" ?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
    <!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 hola ">
            <h6 class="m-0 font-weight-bold text-primary">DataTables </h6>
            <button class="btn btn-info text-End"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                    <path
                        d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0" />
                </svg>&nbsp;Nuevo</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>nombre</th>
                            <th>email</th>
                            <th>oficina</th>
                            <th>Position</th>
                            <th>direccion</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Cedula</th>
                            <th>nombre</th>
                            <th>email</th>
                            <th>oficina</th>
                            <th>Position</th>
                            <th>direccion</th>
                            <th>Eliminar</th>
                            <th>Actualizar</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($todo as $user): ?>
                            <tr>
                                <td><?= $user->cedula ?></td>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->oficina ?></td>
                                <td><?= $user->posición ?></td>
                                <td><?= $user->direcion ?></td>
                                <td>
                                    <form onsubmit="return confirm('estas seguro');" action="index.php?url=eliminar"
                                        method="post">
                                        <input type="hidden" name="id" id="id" value="<?= $user->id_e ?>">
                                        <button class="btn btn-danger" type="submit"><svg
                                                class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td><button data-action="editar"
                                        onclick="aparezcaModal(<?= $user->id_e?>,' <td><?= $user->cedula ?>', '<?= $user->name ?>', '<?= $user->email ?>','<?= $user->oficina ?>','<?= $user->posición ?>','<?= $user->direcion ?>')"
                                        class="btn btn-success" type="submit"><svg
                                            class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button></td>
                            </tr>
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
<div id="mimodal" class="modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg text-center">
            <div class="modal-content text-center">
                <div class="modal-header bg-info text-center">
                    <h2><b>EDITAR REGISTROS</b></h2>
                </div>
                <div class="modal-body">
                    <form id="formix" method="post" action="index.php?url=actualizar">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>id :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" id="modal_id" name="id" maxlength="10" placeholder=""
                                        class="form-control border-success text-uppercase"
                                        onchange="obtenernombredelinput();">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>cedula :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Ecedu" name="Ecedu" />
                                </div>
                            </div> <br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Nombre :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Enom" name="Enom" />
                                </div>
                            </div> <br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Email:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" id="Email" name="Email" class="form-control" />
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>oficina :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Eofi" name="Eofi" />
                                </div>
                        </div> <br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Position :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Epo" name="Epo" />
                                </div>
                        </div> <br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>direccion :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Edire" name="Edire" />
                                </div>
                            </div> <br>
                        <center>
                            <div class="row text-center">
                                <div class="col-md-4"><button type="reset" class="btn btn-dark">LIMPIAR CAMPOS</button>
                                </div>
                                <div class="col-md-4"><input class="btn btn-danger" type="submit"
                                        value="Enviar formulario" /></div>
                            </div>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="cerrarModal()" class="btn btn-danger">CERRAR</button>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function () {
        // Utilizar un evento delegado para manejar los clics en los botones "Editar"
        $('#tablita').on('click', 'button[data-action="editar"]', function () {
            // Obtener referencias a los elementos del DOM
            var $row = $(this).closest('tr');
            var id = $row.find('input[name="id"]').val();
            var cedula = $row.find('td:eq(0)').text();
            var nombre = $row.find('td:eq(1)').text();
            var email = $row.find('td:eq(2)').text();
            var oficina = $row.find('td:eq(3)').text();
            var Position = $row.find('td:eq(4)').text();
            var dire = $row.find('td:eq(5)').text();

            // Verificar si se encontraron los valores
            if (id && cedula &&nombre && email && oficina && Position && dire) {
                // Llenar el modal con los valores de la fila seleccionada
                $('#modal_id').val(id);
                $('#Ecedu').val(cedula);
                $('#Enom').val(nombre);
                $('#Email').val(email);
                $('#Eofi').val(oficina);
                $('#Epo').val(Position);
                $('#Edire').val(dire);
                $('#mimodal').modal('show');
            } else {
                console.error('No se encontraron los valores necesarios para editar.');
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