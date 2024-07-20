<?php require "params/nav.php"; ?>
<style>
        
        .help-text {
            display: none;
        }
        .valid {
            color: green;
        }
        .invalid {
            color: red;
        }
    </style>

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
                                        <input type="text" minlength="3" oninput="validarNombre();" onkeypress="return SoloLetras(event);" class="form-control"
                                            id="Enom" name="Enom" required  disabled/>
                                    </div>
                                    <div id="nombre-salida" class="text-danger"></div>

                                </div>
                                <div class="form-group">
                                    <label for="Eape">Apellido:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" minlength="3" oninput="validarApellido();" onkeypress="return SoloLetras(event);" class="form-control"
                                            id="Eape" name="Eape" required disabled />
                                    </div>
                                    <div id="apellido-salida" class="text-danger"></div>
                                

                                </div>
                                <div class="form-group">
                                    <label for="Email">E-mail:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" oninput="validarCorreo(this);" id="Email" name="Email"
                                            class="form-control" required disabled />
                                    </div>
                                    <div id="mensaje-email" class="text-danger"></div>
                                    <div id="respuesta1"></div>

                                </div>
                                <div class="form-group">
                                    <label for="pas">Contraseña:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" id="pas" name="pas" minlength="6" maxlength="12" class="form-control" required disabled/>
                                    </div>
                                    <div>
                                        <input type="checkbox" onclick="togglePassword('pas')"> Ver contraseña
                                    </div>
                                    <div id="contrasena-salida" class="text-danger"></div>
                                    <div id="campoOK"></div>
                                    <div class="help-text">
                                        La contraseña debe tener:
                                        <ul id="password-requirements" style="list-style-type: none; padding-left: 0;">
                                            <li id="length-req">De 6 a 12 caracteres</li>
                                            <li id="lowercase-req">Una minúscula</li>
                                            <li id="uppercase-req">Una mayúscula</li>
                                            <li id="number-req">Un número</li>
                                            <!-- <li id="special-char-req">Un carácter especial (!@#$%^&*(),.?":{}|<>)</li> -->
                                        </ul>
                                    </div>
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
                                            <select id="Epo" class="form-control" name="Epo" required disabled>
                                                        <?php foreach ($todo as $user1):?>
                                                        <option value="<?= htmlspecialchars($user1->id_r) ?>"><?= htmlspecialchars($user1->nombre) ?></option>
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
                                            <input type="text" maxlength="10" minlength="10" oninput="validarTelefono();"
                                                onkeypress="return SoloNumeros(event);" class="form-control" id="Ecelu"
                                                name="Ecelu" required  disabled oninput="validarTelefono();"/>
                                        </div>
                                        <div id="telefono-salida" class="text-danger"></div>

                                    </div>
                                    <div class="form-group">
                                        <label for="Efe">Fecha de Nacimiento:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" id="Efe" name="Efe" class="form-control" required onkeydown="return false;" disabled/>
                                            <div id="fecha-salida" class="text-danger"></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Edire">Dirección:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                            </div>
                                            <input type="text" oninput="validarDireccion();" minlength="5" class="form-control" id="Edire" name="Edire" required
                                            disabled />
                                        </div>
                                        <div id="direccion-salida" class="text-danger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-6">
                                    <button type="reset" class="btn btn-dark">LIMPIAR CAMPOS</button>
                                </div>
                                <div class="col-md-6">
                                    <input class="btn btn-success" id='btnenviar' type="submit" value="Enviar formulario" disabled/>
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

<script type="text/javascript">
        function habilitarCampos(habilitar) {
            const campos = ["Enom", "Eape", "Email", "pas", "Epo", "Ese", "Ecelu", "Efe", "Edire"];
            campos.forEach(campo => {
                document.getElementById(campo).disabled = !habilitar;
            });
        }

        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling;
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                field.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        function validar() {
            const cad = document.getElementById("Ecedu").value.trim();
            let total = 0;
            const longitud = cad.length;
            const longcheck = longitud - 1;

            if (cad !== "" && longitud === 10) {
                for (let i = 0; i < longcheck; i++) {
                    if (i % 2 === 0) {
                        let aux = cad.charAt(i) * 2;
                        if (aux > 9) aux -= 9;
                        total += aux;
                    } else {
                        total += parseInt(cad.charAt(i)); // parseInt para convertir a número
                    }
                }

                total = total % 10 ? 10 - total % 10 : 0;

                if (cad.charAt(longitud - 1) == total) {
                    document.getElementById("salida").innerHTML = "Cédula Válida";
                    habilitarCampos(true);
                } else {
                    document.getElementById("salida").innerHTML = "Cédula Inválida";
                    $("input").attr('disabled', true); //Desabilito el input nombre
                    $("input#Ecedu").attr('disabled', false); //Habilitando el input cedula
                    
                }
            } else {
                document.getElementById("salida").innerHTML = "";
                habilitarCampos(false);
            }

            validarFormulario();
        }

        function SoloNumeros(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function SoloLetras(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode == 32)
                return true;
            return false;
        }

        function validarcorreo(field) {
            const email = field.value;
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(email)) {
                field.setCustomValidity("Correo electrónico no válido");
            } else {
                field.setCustomValidity("");
            }
        }

        function validarNombre() {
            var nombre = document.getElementById('Enom').value;
            var elemento = document.getElementById('nombre-salida');
            if (nombre.length < 3) {
                elemento.innerHTML = 'El nombre debe tener al menos 3 caracteres';
            } else {
                elemento.innerHTML = '';
            }
            validarFormulario();
        }

        function validarApellido() {
            var apellido = document.getElementById('Eape').value;
            var elemento = document.getElementById('apellido-salida');
            if (apellido.length < 3) {
                elemento.innerHTML = 'El apellido debe tener al menos 3 caracteres';
            } else {
                elemento.innerHTML = '';
            }
            validarFormulario();
        }

        function validarCorreo(field) {
            const email = field.value;
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!regex.test(email)) {
                document.getElementById("mensaje-email").innerHTML = "Correo electrónico no válido";
                field.setCustomValidity("Correo electrónico no válido");
            } else {
                document.getElementById("mensaje-email").innerHTML = "";
                field.setCustomValidity("");
            }
            validarFormulario();
        }


        function validarFormulario() {
            const camposRequeridos = ["Ecedu", "Enom", "Eape", "Email", "pas", "Epo", "Ese", "Ecelu", "Efe", "Edire"];
            let formularioValido = true;

            camposRequeridos.forEach(campo => {
                const elemento = document.getElementById(campo);
                if (elemento.disabled || elemento.value.trim() === "" || !elemento.checkValidity()) {
                    formularioValido = false;
                }
            });

            document.getElementById("btnenviar").disabled = !formularioValido;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Calcular la fecha máxima permitida
            const today = new Date();
            const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate()).toISOString().split('T')[0];
            document.getElementById('Efe').max = maxDate;
        });

        function validarContrasena() {
            var contrasena = document.getElementById('pas').value;
            var elemento = document.getElementById('contrasena-salida');
            var lengthReq = document.getElementById('length-req');
            var lowercaseReq = document.getElementById('lowercase-req');
            var uppercaseReq = document.getElementById('uppercase-req');
            var numberReq = document.getElementById('number-req');
            //var specialCharReq = document.getElementById('special-char-req');

            var regexMayuscula = /[A-Z]/;
            var regexMinuscula = /[a-z]/;
            var regexNumero = /[0-9]/;
            //var regexEspecial = /[!@#$%^&*(),.?":{}|<>]/;

            // Validar longitud
            if (contrasena.length >= 6 && contrasena.length <= 12) {
                lengthReq.classList.add('valid');
                lengthReq.classList.remove('invalid');
            } else {
                lengthReq.classList.add('invalid');
                lengthReq.classList.remove('valid');
            }

            // Validar minúscula
            if (regexMinuscula.test(contrasena)) {
                lowercaseReq.classList.add('valid');
                lowercaseReq.classList.remove('invalid');
            } else {
                lowercaseReq.classList.add('invalid');
                lowercaseReq.classList.remove('valid');
            }

            // Validar mayúscula
            if (regexMayuscula.test(contrasena)) {
                uppercaseReq.classList.add('valid');
                uppercaseReq.classList.remove('invalid');
            } else {
                uppercaseReq.classList.add('invalid');
                uppercaseReq.classList.remove('valid');
            }

            // Validar número
            if (regexNumero.test(contrasena)) {
                numberReq.classList.add('valid');
                numberReq.classList.remove('invalid');
            } else {
                numberReq.classList.add('invalid');
                numberReq.classList.remove('valid');
            }

            //Validar carácter especial
            /*if (regexEspecial.test(contrasena)) {
                specialCharReq.classList.add('valid');
                specialCharReq.classList.remove('invalid');
            } else {
                specialCharReq.classList.add('invalid');
                specialCharReq.classList.remove('valid');
            }*/

            // Mostrar mensaje si la contraseña no es válida
            if (contrasena.length < 6 || contrasena.length > 12 || 
                !regexMayuscula.test(contrasena) || 
                !regexMinuscula.test(contrasena) || 
                !regexNumero.test(contrasena) /*|| 
                !regexEspecial.test(contrasena)*/) {
                elemento.innerHTML = 'La contraseña no cumple con los requisitos.';
            } else {
                elemento.innerHTML = '';
            }
            validarFormulario();
        }

        function validarTelefono() {
            var telefono = document.getElementById('Ecelu').value;
            var elemento = document.getElementById('telefono-salida');
            if (telefono.length != 10) {
                elemento.innerHTML = 'El teléfono debe tener 10 dígitos';
            } else {
                elemento.innerHTML = '';
            }
            validarFormulario();
        }

        function validarDireccion() {
            var direccion = document.getElementById('Edire').value;
            var elemento = document.getElementById('direccion-salida');
            if (direccion.length < 5) {
                elemento.innerHTML = 'La dirección debe tener al menos 5 caracteres';
            } else {
                elemento.innerHTML = '';
            }
            validarFormulario();
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('Ecedu').addEventListener('focus', function() {
                document.getElementById('Ecedu').value = "";
                document.getElementById('salida').innerHTML = "";
                document.getElementById('respuesta').innerHTML = "";
            });

            document.getElementById("pas").addEventListener('focus', function() {
                document.querySelector('.help-text').style.display = 'block';
            });

            document.getElementById("pas").addEventListener('blur', function() {
                document.querySelector('.help-text').style.display = 'none';
            });

            document.getElementById('pas').addEventListener('input', validarContrasena);
        });
        $("#Ecedu").on("keyup", function () {
        var cedula = $("#Ecedu").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#Ecedu").val().length; //CUENTO LONGITUD

        //Valido la longitud 
        if (longitudCedula == 10) {
            var dataString = 'cedula=' + cedula;

            $.ajax({
                url: 'index.php?url=validar',
                type: "GET",
                data: dataString,
                dataType: "JSON",

                success: function (datos) {

                    if (datos.success == 1) {

                        $("#respuesta").html(datos.message);

                        $("input").attr('disabled', true); //Desabilito el input nombre
                        $("input#Ecedu").attr('disabled', false); //Habilitando el input cedula
                        $("#btnEnviar").attr('disabled', true); //Desabilito el Botton

                    } else {

                        $("#respuesta").html(datos.message);

                        $("input").attr('disabled', false); //Habilito el input nombre
                        $("#btnEnviar").attr('disabled', false); //Habilito el Botton

                    }
                }
            });
        }
    });
    // validar Correo 
    $("#Email").on("keyup", function () {
        var email = $("#Email").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCorreo = $("#Email").val().length; //CUENTO LONGITUD

        //Valido la longitud 
        if (longitudCorreo  >=1 )  {
            var dataString = 'email=' + email;

            $.ajax({
                url: 'index.php?url=correo',
                type: "GET",
                data: dataString,
                dataType: "JSON",

                success: function (datos) {

                    if (datos.success == 1) {

                        $("#respuesta1").html(datos.message);
                        
                        $("input").attr('disabled', true); //Desabilito el input nombre
                        $("input#Ecedu").attr('disabled', false); //Habilitando el input cedula
                        $("input#Email").attr('disabled', false); //Habilitando el input cedula
                        $("input#Enom").attr('disabled', false); //Habilitando el input cedula
                        $("input#Eape").attr('disabled', false); //Habilitando el input cedula
                        $("input#pas").attr('disabled', false); //Habilitando el input cedula
                        $("input#Epo").attr('disabled', false); //Habilitando el input cedula
                        $("input#Ese").attr('disabled', false); //Habilitando el input cedula
                        $("input#Ecelu").attr('disabled', false); //Habilitando el input cedula
                        $("input#Efe").attr('disabled', false); //Habilitando el input cedula
                        $("input#Edire").attr('disabled', false); //Habilitando el input cedula
                        





                        //$("#btnEnviar").attr('disabled', true); //Desabilito el Botton

                    } else {

                        $("#respuesta1").html(datos.message);

                        $("input").attr('disabled', false); //Habilito el input nombre
                        //$("#btnEnviar").attr('disabled', false); //Habilito el Botton

                    }
                }
            });
        }
        
    });
    </script>