function aparezcaModal(id,cedula, nombre, email,oficina,position,dire) {
    document.getElementById('modal_id').value = id;
    document.getElementById('Ecedu').value = cedula;
    document.getElementById('Enom').value = nombre;
    document.getElementById('Email').value = email;
    document.getElementById('Eofi').value = oficina;
    document.getElementById('Epo').value = position;
    document.getElementById('Edire').value = dire;
    $('#mimodal').modal('show'); // Esto muestra el modal
    
}

function cerrarModal(){
    $("#mimodal").modal("hide");
}

function aparezcaModal2() {
    
    $('#mimodal2').modal('show'); // Esto muestra el modal
    
}

function cerrarModal2(){
    $("#mimodal2").modal("hide");
}
// function aparezcaModal(id, nom, cedu, fnaci){
//     $("#mimodal").modal("show");
//     $("#Enombre").val(nom);
//     $("#Eced").val(cedu);
//     $("#idempleado").val(id);
//     $("#Efnac").val(fnaci);
// }


// function aparezcaModal(id) {
//     document.getElementById('id').value = id; // Actualiza el valor del campo id en el modal
    
// }

