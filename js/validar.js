function enviarFormulario() {
    var formulario = document.getElementById("miFormulario");
    formulario.action = window.location.href; // Establece la acción del formulario a la URL actual
    formulario.submit(); // Envía el formulario
}

function volverARegistro() {
    window.location.href = window.location.href; // Redirige a la misma página
}

function SoloNumeros(e){
    var tecla = (document.all) ? e.keyCode : e.which;// 2
    if (tecla==8) return true; // 3
    var patron =/[0-9]/; // 4
    var te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}

function SoloLetras(e){
    var tecla = (document.all) ? e.keyCode : e.which;// 2
    if (tecla==8) return true; // 3
    var patron =/[A-Za-z\s]/; // 4
    var te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
}
// function validarcorreo(){
//     var correo = $("#Email").val();
//     var patron  = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
//     if (patron.test(correo) == false){
//         // alert("correo mal escrito");
//         $("#Email").val("");
//     }

// }

$(document).ready(function () {
    $('#tablita').DataTable();
});

//desabilitar el boton de enviar hasta que los campos esten llenos 

window.onload = function () {
    // Obtener referencias a los campos y al botón
    var ceduInput = document.getElementById("cedu");
    var nomInput = document.getElementById("nom");
    var apeInput = document.getElementById("ape");
    var submitButton = document.getElementById("submitButton");

    // Función para verificar si todos los campos están llenos
    function checkInputs() {
        if (ceduInput.value !== "" && nomInput.value !== "" && apeInput.value !== "") {
            submitButton.disabled = false; // Habilitar el botón
        } else {
            submitButton.disabled = true; // Deshabilitar el botón
        }
    }

    // Agregar oyentes de eventos a los campos de entrada
    ceduInput.addEventListener("input", checkInputs);
    nomInput.addEventListener("input", checkInputs);
    apeInput.addEventListener("input", checkInputs);
};

