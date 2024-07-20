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
//Alerta de eliminar
function confirmDeletion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Este usuario será desactivado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, desactivarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + id).submit();
        }
    });
}
//Alerta de actiavr
function confirmActivar(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Este usuario será activado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Activarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('activarForm' + id).submit();
        }
    });
}

function validar() {
    var cad = document.getElementById("Ecedu").value.trim();
    var total = 0;
    var longitud = cad.length;
    var longcheck = longitud - 1;

    if (cad !== "" && longitud === 10) {
      for (var i = 0; i < longcheck; i++) {
        if (i % 2 === 0) {
          var aux = cad.charAt(i) * 2;
          if (aux > 9) aux -= 9;
          total += aux;
        } else {
          total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
        }
      }

      total = total % 10 ? 10 - total % 10 : 0;

      if (cad.charAt(longitud - 1) == total) {
        document.getElementById("salida").innerHTML = "Cédula Válida";
        habilitarCampos(true);
      } else {
        document.getElementById("salida").innerHTML = "Cédula Inválida";
        habilitarCampos(false);
      }
    } else {
      document.getElementById("salida").innerHTML = ""; // Limpia el mensaje si la cédula no tiene 10 caracteres
      habilitarCampos(false);
    }
  }

  function habilitarCampos(habilitar) {
    var campos = document.querySelectorAll("#Enom, #Eape, #Email, #pas, #Epo, #Ese, #Ecelu, #Efe, #Edire");
    campos.forEach(function(campo) {
      campo.disabled = !habilitar;
    });
  }