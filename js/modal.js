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

