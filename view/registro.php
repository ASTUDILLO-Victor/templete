<?php require "params/nav.php"; ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="container mt-5">
                <div class="card-header py-3 hola ">
                    <h1 class="m-0 font-weight-bold text-primary">Registro de Usuarios </h1>
                    <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1): ?>
                        <!-- Código específico para usuarios -->
                        <button onclick="window.location.href = 'index.php?url=tables'" class="btn btn-info text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M16 8a8 8 0 1 0-16 0 8 8 0 0 0 16 0zM8 4a.5.5 0 0 1 .5.5v2.5H11a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V8.5H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z" />
                            </svg>&nbsp;Volver
                        </button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 2): ?>
                        <!-- Código específico para usuarios -->
                        <button onclick="window.location.href = 'index.php?url=tables3'" class="btn btn-info text-end">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M16 8a8 8 0 1 0-16 0 8 8 0 0 0 16 0zM8 4a.5.5 0 0 1 .5.5v2.5H11a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V8.5H5a.5.5 0 0 1 0-1h2.5V4.5A.5.5 0 0 1 8 4z" />
                            </svg>&nbsp;Volver
                        </button>
                    <?php endif ?>



                </div>
                <div class="border p-4">
                    <form id="formix" method="post" action="index.php?url=crear">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Ecedu">Cédula:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" maxlength="10" minlength="10"
                                            onkeypress="return SoloNumeros(event);" class="form-control" id="Ecedu"
                                            name="Ecedu" oninput="validar()" required />
                                    </div>
                                    <div id="salida" class="text-danger"></div>
                                    <div id="respuesta"></div>
                                </div>
                                <div class="form-group">
                                    <label for="Enom">Nombre:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                            id="Enom" name="Enom" required disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Eape">Apellido:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                            id="Eape" name="Eape" required disabled />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Email">E-mail:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" onchange="validarcorreo(this);" id="Email" name="Email"
                                            class="form-control" required disabled />
                                    </div>
                                    <div id="respuesta1"></div>
                                    <div id="respuesta2"></div>
                                </div>
                                <div class="form-group">
                                    <label for="pas">Contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" id="pas" name="pas" minlength="6" maxlength="12"
                                            class="form-control" required disabled />
                                            <span class="help-text"> 
                                                    La contraseña debe tener de 6 a 12 caracteres
                                                    incluir caracteres especiales como: !@#$%^&*(),.?":{}|<>]
                                                    incluir una Mayusculas
                                                    Incluir una minuscula
                                            </span>
                                            <br>
                                    </div>
                                    <span id="campoOK"></span>
                                </div>
                                
                            </div>
                                <!-- Código específico para usuarios -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Epo">Rol:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                            </div>
                                            
                                                <select id="Epo" class="form-control" name="Epo" disabled>
                                                <?php foreach ($todo as $user):?>
                                                <option value="<?= htmlspecialchars($user->id_rol) ?>"><?= htmlspecialchars($user->nombre) ?></option>
                                                
                                                <?php endforeach?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                
                                                    
                                    <div class="form-group">
                                        <label for="Ese">Sexo:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                            </div>
                                            <select id="Ese" class="form-control" name="Ese" disabled>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="Prefiero no contestar">Prefiero no contestar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Ecelu">Teléfono:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" maxlength="10" minlength="10"
                                                onkeypress="return SoloNumeros(event);" class="form-control" id="Ecelu"
                                                name="Ecelu" required disabled />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Efe">Fecha de Nacimiento:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" class="form-control" id="Efe" name="Efe" required
                                                disabled />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Edire">Dirección:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="Edire" name="Edire" required
                                                disabled />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-dark">LIMPIAR CAMPOS</button>
                                </div>
                                <div class="col-md-6">
                                    <input class="btn btn-success" id="btnenviar"type="submit" value="Enviar formulario" />
                                </div>
                            </div>
                            <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 2): ?>
                                <!-- Código específico para usuarios -->
                                <input type="hidden" id="tabla" name="tabla" value="tables3">
                            <?php endif ?>
                            <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1): ?>
                                <!-- Código específico para usuarios -->
                                <input type="hidden" name="tabla" value="tables">
                            <?php endif ?>
                    </form>
                </div>
            </div>
        </div>
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
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

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
<style>
        .help-text {
            display: none;
            color: grey;
            font-size: 0.9em;
        }
        input:focus + .help-text {
            display: block;
        }
    </style>
<style>
        .input-valid {
            background-color: lightgreen;
        }
        .input-invalid {
            background-color: lightcoral;
        }
    </style>
    