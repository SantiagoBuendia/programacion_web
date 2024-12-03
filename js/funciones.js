function limpiar(){
    document.form.reset();
    document.form.cod.focus();
}
function validar(){
    var form = document.form;
    if(form.cod.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el codigo'
         });
         form.cod.value="";
         form.cod.focus();
         return false;
    }
    if(form.nom.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el Nombre'
         });
         form.nom.value="";
         form.nom.focus();
         return false;
    }
    if(form.ape.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el Apellido'
         });
         form.ape.value="";
         form.ape.focus();
         return false;
    }
    if(form.em.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el EMAIL'
         });
         form.em.value="";
         form.em.focus();
         return false;
    }
    if(form.tel.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe digitar el Telefono'
         });
         form.tel.value="";
         form.tel.focus();
         return false;
    }
    if(form.fen.value==0){
        Swal.fire({
            icon:'error',
            title:'ERROR!!',
            text : 'Debe Seleccionar la Fecha de Nacimiento'
         });
         form.fen.value="";
         form.fen.focus();
         return false;
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