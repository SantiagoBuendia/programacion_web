<?php
session_start();
include('class.php');
class Login
{
    public function validar($correo, $pass)
    {
        $sql = "select * from usuario where correo='$correo' and contraseña='$pass'";
        $res = mysqli_query(Conectar::conec(), $sql);
        if ($row = mysqli_fetch_array($res)) {
            //se crea la variable de SESION
            $_SESSION['usuario'] = $row['nombre'];
            $_SESSION['cargo'] = $row['cargo'];
            echo "
            <script type='text/javascript'>
                Swal.fire({
                    icon: 'success',
                    title: 'BIENVENIDO',
                    text: '" . $_SESSION['usuario'] . " Bienvenido al sistema'
                }).then((result) => {
                    if(result.isConfirmed){
                        if('" . $_SESSION['cargo'] . "' === 'administrador'){
                            window.location='./menua.php';
                        } else if('" . $_SESSION['cargo'] . "' === 'usuario'){ 
                            window.location='./menuu.php';
                        }
                    }
                }); </script>";
        } else {
            $_SESSION['usuario'] = NULL;
            echo "
                <script type='text/javascript'>
                    Swal.fire({
                        icon : 'error',
                        title : 'ERROR!!',
                        text :  'El correo o contraseña no son correctos'
                    }).then((result) => {
                        if(result.isConfirmed){
                        window.location='./index.php';
                    }
                }); </script>";
        }
    }
}

class Nuevo
{
    public function registrar($correo, $nombre, $contraseña, $fecha_nacimiento, $telefono)
    {
        if ($this->get_usu($correo)) {
            echo "
                <script type='text/javascript'>
                    Swal.fire({
                        icon: 'info',
                        title: 'Información',
                        text: 'Esta dirección de correo electrónico ya está en uso'
                    }).then((result) => {
                        if(result.isConfirmed){
                            window.location='./index.php';
                        }
                    });
                </script>";
        }else{
            $sql="insert into usuario values ('$correo', '$nombre', '$contraseña', '$fecha_nacimiento', 'usuario', $telefono)";
            $res=mysqli_query(Conectar::conec(),$sql);
            echo "
            <script type='text/javascript'>
                Swal.fire({
                    icon : 'success',
                    title : 'Operacion Exitosa!!',
                    text :  'Registrado correctamente'
                }).then((result) => {
                    if(result.isConfirmed){
                        window.location='./index.php';
                    }
                });
            </script>";
        }
    }
    //metodo para obtener el correo por el correo que ingresa el usuario
    public function get_usu($campo)
    {
        $sql = "select correo from usuario where correo ='$campo'";
        $res = mysqli_query(Conectar::conec(), $sql);
        return mysqli_num_rows($res) > 0;
    }
}
?>
