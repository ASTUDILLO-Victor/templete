function habilitarCampos(habilitar) {
    const campos = ["Enom", "Eape", "Email", "pas", "Epo", "Ese", "Ecelu", "Efe", "Edire"];
    campos.forEach(campo => {
        document.getElementById(campo).disabled = !habilitar;
    });
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
                total += parseInt(cad.charAt(i));
            }
        }

        total = total % 10 ? 10 - total % 10 : 0;

        if (cad.charAt(longcheck) == total) {
            document.getElementById("salida").innerHTML = "Cédula Válida";
            validarCedula(cad);
        } else {
            document.getElementById("salida").innerHTML = "Cédula Inválida";
            habilitarCampos(false);
            document.getElementById("respuesta").innerHTML = "";
        }
    } else {
        document.getElementById("salida").innerHTML = "";
        habilitarCampos(false);
        document.getElementById("respuesta").innerHTML = "";
    }
}

function SoloNumeros(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function SoloLetras(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122) || charCode == 32) return true;
    return false;
}

function validarcorreo(field) {
    const email = field.value;
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    field.setCustomValidity(regex.test(email) ? "" : "Correo electrónico no válido");
}

function validarCedula(cedula) {
    var dataString = 'cedula=' + cedula;
    $.ajax({
        url: 'index.php?url=validar',
        type: "GET",
        data: dataString,
        dataType: "JSON",
        success: function (datos) {
            $("#respuesta").html(datos.message);
            if (datos.success) {
                habilitarCampos(false); // Cédula existe, deshabilitar campos
                $("#btnenviar").attr('disabled', true);
            } else {
                habilitarCampos(true); // Cédula no existe, habilitar campos
                $("#btnenviar").attr('disabled', false);
            }
        },
        error: function () {
            $("#respuesta").html("Error en la validación de la cédula.");
            habilitarCampos(false);
            $("#btnenviar").attr('disabled', true);
        }
    });
}


$(document).ready(function () {
    $("#Ecedu").on("keyup", function () {
        $("#respuesta").html(""); // Limpiar mensaje de respuesta al escribir
        validar();
    });

    $("#Email").on("keyup", function () {
        var email = $(this).val();
        var regex = /^[a-zA-Z0-9._%+-]+@(outlook\.com|outlook\.es)$/;

        if (regex.test(email)) {
            $("#respuesta1").html("Correo válido de Outlook.");
            $("#btnenviar").attr('disabled', false);
        } else {
            $("#respuesta1").html("Por favor, ingrese un correo de Outlook válido.");
            $("#btnenviar").attr('disabled', true);
        }
    });

    const passwordInput = document.getElementById('pas');
    const validityIndicator = document.getElementById('campoOK');
    const submitButton = document.getElementById('btnenviar');
    const regexPassword = /^(?=.*\d)(?=.*[a-záéíóúüñ])(?=.*[A-ZÁÉÍÓÚÜÑ])(?=.*[!@#$%^&*(),.?":{}|<>])/;

    passwordInput.addEventListener('input', function(evt) {
        const campo = evt.target;
        if (campo.value.length === 0) {
            validityIndicator.innerText = "";
            campo.classList.remove('input-valid', 'input-invalid');
            submitButton.disabled = true;
        } else if (regexPassword.test(campo.value)) {
            validityIndicator.innerText = "válido";
            validityIndicator.style.color = "green";
            campo.classList.add('input-valid');
            campo.classList.remove('input-invalid');
            submitButton.disabled = false;
        } else {
            validityIndicator.innerText = "incorrecto";
            validityIndicator.style.color = "red";
            campo.classList.add('input-invalid');
            campo.classList.remove('input-valid');
            submitButton.disabled = true;
        }
    });

    document.getElementById('pass').addEventListener('focus', function() {
        document.querySelector('.help-text').style.display = 'block';
    });

    document.getElementById('pass').addEventListener('blur', function() {
        if (passwordInput.value.length === 0) {
            validityIndicator.innerText = "";
            passwordInput.classList.remove('input-valid', 'input-invalid');
        }
        document.querySelector('.help-text').style.display = 'none';
    });
});