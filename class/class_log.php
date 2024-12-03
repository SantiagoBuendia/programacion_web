<?php
session_start();
include('class.php');
class Login
{
    public function validar($user, $pass)
    {
        $sql = "select * from usuario where correo='$user' and contraseña='$pass'";
        $res = mysqli_query(Conectar::conec(), $sql);
        if ($row = mysqli_fetch_array($res)) {
            //se crea la variable de SESION
            $_SESSION['usuario'] = $row['correo'];
            $_SESSION['cargo'] = $row['cargo'];
            echo "
    <script type='text/javascript'>
        Swal.fire({
            icon: 'success',
            title: 'BIENVENIDO',
            text: '" . $_SESSION['usuario'] . " al Sistema'
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
                 text :  ' el usuario $user o password  no son correctos'
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
        $sql="insert into usuario values ('$correo', '$nombre', '$contraseña', '$fecha_nacimiento', 'usuario', $telefono)";
        $res=mysqli_query(Conectar::conec(),$sql);
        echo "
        <script type='text/javascript'>
        Swal.fire({
           icon : 'success',
           title : 'Operacion Exitosa!!',
           text :  'insertado Correctamente'
        }).then((result) => {
            if(result.isConfirmed){
                window.location='./menuu.php';
            }
        });
        </script>";
    }
}
?>