function limpiar(){
    document.form.reset();
    document.form.cod.focus();
}
function validar(){
    var form = document.form;
    if(form.cod.value==0){
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            text : 'Debe digitar el codigo'
        });
        form.cod.value="";
        form.cod.focus();
        return false;
    }
    if(form.nom.value==0){
        Swal.fire({
            icon: 'error',
            title: 'ERROR!!',
            text : 'Debe digitar el nombre'
        });
        form.nom.value="";
        form.nom.focus();
        return false;
    }
    if(form.correo.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el correo electrónico'
        });
        form.correo.value="";
        form.correo.focus();
        return false;
    }
    if(form.tel.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el telefono'
        });
        form.tel.value="";
        form.tel.focus();
        return false;
    }
    if(form.fecha_nacimiento.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe Seleccionar la Fecha de Nacimiento'
        });
        form.fecha_nacimiento.value="";
        form.fecha_nacimiento.focus();
        return false;
    }
    form.submit();
}

//Validar inicio sesión
function validarInicioSesion(event){
    event.preventDefault();

    var form = document.form;
    var camposAValidar = [
        { nombre: 'correo', mensaje: 'Debe digitar el correo' },
        { nombre: 'passw', mensaje: 'Debe digitar la contraseña' }
    ];

    for (var i = 0; i < camposAValidar.length; i++) {
        var campo = camposAValidar[i];
        var valorCampo = form[campo.nombre].value.trim();

        if (valorCampo === '') {
            Swal.fire({
                icon: 'error',
                title: 'ERROR!!',
                text: campo.mensaje
            });
            
            form[campo.nombre].value = '';
            form[campo.nombre].focus();
            return false;
        }
    }
    form.submit(); 
}

// Validar Registro de usuario
function validarRegistroU(event){
    event.preventDefault();

    var form = document.form;
    var camposAValidar = ['correo', 'nom', 'passw', 'fech_na', 'tel'];

    for (var i = 0; i < camposAValidar.length; i++) {
        var valorCampo = form[camposAValidar[i]].value.trim();
        if (valorCampo === '') {
            Swal.fire({
                icon: 'error',
                title: 'ERROR!!',
                text: 'Rellene todos los campos'
            });
            
            form[camposAValidar[i]].value = '';
            form[camposAValidar[i]].focus();
            return false;
        }
    }
    form.submit(); 
}

//funcion eliminar
function eliminar(url){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location=url;        
        }
    })
}

function mostrarRecuperarContrasena() {
    document.getElementById('recuperarContrasena').style.display = 'block';
}

