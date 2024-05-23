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