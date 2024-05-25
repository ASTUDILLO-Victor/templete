<div id="mimodal2" class="modal borde" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-lg text-center">
            <div class="modal-content text-center">
                <div class="modal-header bg-primary text-center text-white">
                    <h2><b>EDITAR REGISTROS</b></h2>
                </div>
                <div class="modal-body">
                    <form id="formix" method="post" action="index.php?url=crear">
                        <div class="form-group">
                            <div class="row"> 
                                <div class="col-md-9">
                                    <input type="hidden" id="modal_id" name="id" maxlength="10" placeholder=""
                                        class="form-control border-success text-uppercase"
                                        onchange="obtenernombredelinput();" >
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>cedula :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" maxlength="10" minlength="10" onkeypress="return SoloNumeros(event);" class="form-control"
                                        id="Ecedu" name="Ecedu" required/>
                                </div>
                            </div> <br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Nombre :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control toUpperCase()"
                                        id="Enom" name="Enom" required/>
                                </div>
                            </div> <br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Email:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email"  id="Email" name="Email" class="form-control" required/>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>password:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" id="pas" name="pas" minlength="6" maxlength="6" class="form-control" required/>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>oficina :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control"
                                        id="Eofi" name="Eofi" required/>
                                </div>
                        </div> <br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>Rol:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" onkeypress="return SoloLetras(event);" class="form-control"
                                        id="Epo" name="Epo" required/>
                                </div>
                        </div> <br>
                        <div class="row">
                                <div class="col-md-3 text-right">
                                    <label>direccion :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text"  class="form-control"
                                        id="Edire" name="Edire" required/>
                                </div>
                            </div> <br>
                        <center>
                            <div class="row text-center">
                                <div class="col-md-4"><button type="reset" class="btn btn-dark">LIMPIAR CAMPOS</button>
                                </div>
                                <div class="col-md-4"><input class="btn btn-info text-white" type="submit"
                                        value="Enviar formulario" /></div>
                            </div>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="cerrarModal2()" class="btn btn-danger">CERRAR</button>
                </div>
            </div>
        </div>
    </div>