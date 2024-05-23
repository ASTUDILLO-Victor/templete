function aparezcaModal(id, nombre, email) {
    // document.getElementById('modal_id').value = id;
    // document.getElementById('Enom').value = nombre;
    // document.getElementById('Email').value = email;
    $('#mimodal').modal('show'); // Esto muestra el modal
    
}

function cerrarModal(){
    $("#mimodal").modal("hide");
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

