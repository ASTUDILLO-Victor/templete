<div id="mimodal" class="modal borde" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h2><b>EDITAR REGISTROS</b></h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" onclick="cerrarModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formix" method="post" action="index.php?url=actualizar">
                    <input type="hidden" id="modal_id" name="id" class="form-control border-success text-uppercase" onchange="obtenernombredelinput();">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Ecedu">Cédula:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" maxlength="10" minlength="10" onkeypress="return SoloNumeros(event);" class="form-control" id="Ecedu" name="Ecedu" readonly required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Enom">Nombre:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control" id="Enom" name="Enom" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Eape">Apellido:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control" id="Eape" name="Eape" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Email">E-mail:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" onchange="validarcorreo(Email);" id="Email" name="Email" class="form-control" required/>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="Epo">Rol:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    </div>
                                    <select id="Epo" class="form-control" name="Epo">
                                        <option value="1">SuperAdmin</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Usuario</option>
                                    </select>
                                </div>
                            </div> -->
                            
                        <!-- Código específico para usuarios -->
                            <div class="form-group">
                                <label for="Epo">Rol:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    </div>                                
                                    <select id="Epo" class="form-control" name="Epo" required>
                                                <?php foreach ($todo1 as $user1):?>
                                                <option value="<?= htmlspecialchars($user1->id_rol) ?>"><?= htmlspecialchars($user1->nombre) ?></option>
                                                <?php endforeach?>
                                            </select>
                                </div>

                            </div>
                    
                    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Ese">Sexo:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select id="Ese" class="form-control" name="Ese">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="no">Prefiero no contestar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Ecelu">Teléfono:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" maxlength="10" minlength="10" onkeypress="return SoloNumeros(event);" class="form-control" id="Ecelu" name="Ecelu" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Efe">Fecha de Nacimiento:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" id="Efe" name="Efe" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Edire">Dirección:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="Edire" name="Edire" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-dark">LIMPIAR CAMPOS</button>
                        </div>
                        <div class="col-md-6">
                            <input class="btn btn-success" type="submit" value="Enviar formulario" />
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

<script>
$(document).ready(function () {
    $('#tablita').on('click', 'button[data-action="editar"]', function () {
        var $row = $(this).closest('tr');
        var id = $row.find('input[name="id"]').val();
        var cedula = $row.find('td:eq(0)').text();
        var nombre = $row.find('td:eq(1)').text();
        var ape = $row.find('td:eq(2)').text();
        var email = $row.find('td:eq(3)').text();
        var Rol = $row.find('td:eq(4)').text();
        var sex = $row.find('td:eq(5)').text();
        var celu= $row.find('td:eq(6)').text();
        var fecha = $row.find('td:eq(7)').text();
        var dire = $row.find('td:eq(8)').text();

        if (id && cedula &&nombre && ape && email && Rol && sex && celu && fecha && dire ) {
            $('#modal_id').val(id);
            $('#Ecedu').val(cedula);
            $('#Enom').val(nombre);
            $('#Eape').val(ape);
            $('#Email').val(email);
            $('#Epo').val(Rol);
            $('#Ese').val(sex);
            $('#Ecelu').val(celu);
            $('#Efe').val(fecha);
            $('#Edire').val(dire);
            
            $('#mimodal').modal('show');
        } else {
            console.error('No se encontraron los valores necesarios para editar.');
        }
    });
});
</script>

<style>
.borde {
    border-radius: 30px;
}
</style>
