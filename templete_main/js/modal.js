function aparezcaModal(id,cedula, nombre,ape,email,Rol,sexo,celu,fecha,dire) {
    document.getElementById('modal_id').value = id;
    document.getElementById('Ecedu').value = cedula;
    document.getElementById('Enom').value = nombre;
    document.getElementById('Eape').value = ape;
    document.getElementById('Email').value = email;
    document.getElementById('Epo').value = Rol;
    document.getElementById('Ese').value = sexo;
    document.getElementById('Ecelu').value = celu;
    document.getElementById('Efe').value = fecha;
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

function aparezcaModal3() {
    
    $('#mimodal3').modal('show'); // Esto muestra el modal
    
}

function cerrarModal3(){
    $("#mimodal3").modal("hide");
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

function aparezcaModal4(id,cedula, nombre,ape,email,Rol,sexo,celu,fecha,dire) {
    document.getElementById('modal_id').value = id;
    document.getElementById('Ecedu').value = cedula;
    document.getElementById('Enom').value = nombre;
    document.getElementById('Eape').value = ape;
    document.getElementById('Email').value = email;
    document.getElementById('Epo').value = Rol;
    document.getElementById('Ese').value = sexo;
    document.getElementById('Ecelu').value = celu;
    document.getElementById('Efe').value = fecha;
    document.getElementById('Edire').value = dire;
    
    $('#mimodal4').modal('show'); // Esto muestra el modal
    
}
function cerrarModal4(){
    $("#mimodal4").modal("hide");
}

function aparezcaModal5() {
    
    $('#mimodal5').modal('show'); // Esto muestra el modal
    
}

function cerrarModal5(){
    $("#mimodal5").modal("hide");
}