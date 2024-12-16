function limpiar(){
    document.form.reset();
    document.form.cod.focus();
}
var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;

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
                icon: 'warning',
                title: '¡Atención!',
                text: campo.mensaje
            });
            
            form[campo.nombre].value = '';
            form[campo.nombre].focus();
            return false;
        }

        if(campo.nombre == 'correo' && !expReg.test(form.correo.value.trim())){
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Ingrese un correo valido'
            });
            
            form.correo.value = '';
            form.correo.focus();
            return false;
        }
    }

    
    
    form.submit(); 
}

// Validar Registro de usuario
function validarRegistroU(event){
    event.preventDefault();

    var form = document.signupform;
    var camposAValidar = ['correo', 'nom', 'passw', 'fech_na', 'tel'];

    for (var i = 0; i < camposAValidar.length; i++) {
        var valorCampo = signupform[camposAValidar[i]].value.trim();
        if (valorCampo === '') {
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Rellene todos los campos'
            });
            
            signupform[camposAValidar[i]].value = '';
            signupform[camposAValidar[i]].focus();
            return false;
        }

        //validar que el correo sea valido
        if(camposAValidar[i] == 'correo' && !expReg.test(signupform.correo.value.trim())){
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Ingrese un correo valido'
            });
            
            signupform.correo.value = '';
            signupform.correo.focus();
            return false;
        }

        //validar que el telefono este en los limites establecidos (8-10)
        if(signupform.tel.value.trim().length < 8 || signupform.tel.value.trim().length > 10 || 
        !/^\d+$/.test(signupform.tel.value.trim())){
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Ingrese un número de teléfono valido'
            });
            
            signupform.tel.value = '';
            signupform.tel.focus();
            return false;
        }

        var fechaReg = /^\d{2}-\d{2}-\d{4}$/
        if(!fechaReg.test(signupform.fech_na.value)){
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Ingrese una fecha valida'
            });
            
            signupform.fech_na.value = '';
            signupform.fech_na.focus();
            return false;
        }
    }
    form.submit(); 
}

// Validar campos base

function validarCampos(event, clase){
    event.preventDefault();

    var form = document.form;

    var camposAValidarPersonal = [
        { nombre: 'cod', mensaje: 'Debe digitar el código del piloto o miembro' },
        { nombre: 'nom', mensaje: 'Debe digitar el nombre del piloto o miembro' },
        { nombre: 'base', mensaje: 'Debe seleccionar la base de regreso' },
        { nombre: 'tip_per', mensaje: 'Debe seleccionar el tipo de personal' },
    ];

    var camposAValidarAvion = [
        { nombre: 'cod', mensaje: 'Debe digitar el código del avión' },
        { nombre: 'tip', mensaje: 'Debe digitar el tipo de avión' },
        { nombre: 'base', mensaje: 'Debe seleccionar la base de mantenimiento del avión' }
    ];

    var camposAValidarBase = [
        { nombre: 'nom', mensaje: 'Debe digitar el nombre de la base de mantenimiento' }
    ];

    var camposAValidarVuelo = [
        { nombre: 'cod', mensaje: 'Debe digitar el código de vuelo' },
        { nombre: 'org', mensaje: 'Debe digitar el lugar de origen' },
        { nombre: 'dest', mensaje: 'Debe digitar el lugar de destino' },
        { nombre: 'hora', mensaje: 'Debe ingreasr la hora del vuelo' },
        { nombre: 'fecha', mensaje: 'Debe ingresar la fecha del vuelo' },
        { nombre: 'avion', mensaje: 'Debe seleccionar el avión del vuelo' }
    ];

    var camposAValidarPilo_Miem = [
        { nombre: 'cod', mensaje: 'Debe digitar el código del ' + (clase == 'piloto' ? 'piloto' : 'miembro')},
        { nombre: 'num', mensaje: 'Debe seleccionar el número de vuelo' }
    ];

    var camposAValidar;

    if(clase == 'personal'){
        camposAValidar = camposAValidarPersonal;
    }else if(clase == 'avion'){
        camposAValidar = camposAValidarAvion;
    }else if(clase == 'base'){
        camposAValidar = camposAValidarBase;
    }else if(clase == 'vuelo'){
        camposAValidar = camposAValidarVuelo;
    }else if(clase == 'piloto' || clase == 'miembro'){
        camposAValidar = camposAValidarPilo_Miem;
    }

    for (var i = 0; i < camposAValidar.length; i++) {
        var campo = camposAValidar[i];
        var valorCampo = form[campo.nombre].value.trim();

        if (valorCampo === '') {
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: campo.mensaje
            });
            
            form[campo.nombre].value = '';
            form[campo.nombre].focus();
            return false;
        }

        // validar que el código(cédula) es valido
        if(clase == 'personal'){
            if(form.cod.value.trim().length < 8 || form.cod.value.trim().length > 10 || parseInt(form.cod.value.trim()) <= 0){
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: 'Ingrese un código valido (8-10 dígitos y positivo)'
                });
                form.cod.value = '';
                form.cod.focus();
                return false;
            }

            if (form.tip_per.value === 'piloto') {
                if (form.h_vuelo.value.trim() === '') {
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Atención!',
                        text: 'Debe digitar las horas de vuelo'
                    });
                    form.h_vuelo.value = '';
                    form.h_vuelo.focus();
                    return false;
                }else if(parseInt(form.h_vuelo.value.trim()) <= 0){
                    Swal.fire({
                        icon: 'warning',
                        title: '¡Atención!',
                        text: 'Las horas de vuelo deben ser positivas'
                    });
                    form.h_vuelo.value = '';
                    form.h_vuelo.focus();
                    return false;
                }
            }
        }else if(clase == 'avion'){
            var codAvReg = /^[A-Za-z]{2}[0-9]{2}$/;
            if(!codAvReg.test(form.cod.value.trim())){
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: 'Ingrese un código valido (AB12)'
                });
                form.cod.value = '';
                form.cod.focus();
                return false;
            }
        }else if(clase == 'vuelo'){
            var codVuReg = /^[A-Za-z]{2,3}[0-9]{1,5}$/;
            if(!codVuReg.test(form.cod.value.trim())){
                Swal.fire({
                    icon: 'warning',
                    title: '¡Atención!',
                    text: 'Ingrese un código valido (AA12345)'
                });
                form.cod.value = '';
                form.cod.focus();
                return false;
            }
        }
    }
    form.submit(); 
}


//funcion eliminar
function eliminar(url){
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrá revertir esta acción!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location=url;
        }
    })
}

// Mostrar campor horas de vuelo si es piloto
function activarHorasVuelo() {
    var pilotoRadio = document.getElementById('piloto');
    var horasVueloContainer = document.getElementById('horas_vuelo_container');
    var horasVueloInput = document.getElementById('horas_vuelo');
    
    if (pilotoRadio.checked) {
        horasVueloContainer.style.display = 'block';
        horasVueloInput.required = true;
    } else {
        horasVueloContainer.style.display = 'none';
        horasVueloInput.required = false;
        horasVueloInput.value = '';
    }
}