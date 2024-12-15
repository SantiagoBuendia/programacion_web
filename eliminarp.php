<?php
session_start();
$inn=500;
if(isset($_SESSION['timeout'])){
    $_session_life = time() - $_SESSION['timeout'];
     if($_session_life > $inn){
        session_destroy();
        header("location:./index.php");
     }
}
$_SESSION['timeout']=time();
if($_SESSION['usuario']){
include('./class/class.php');
$pers=new Personal();
$pers->eliminarpers($_GET['id']);
}else{
    $_SESSION['usuario']=NULL;
    echo "
    <script type='text/javascript'>
     Swal.fire({
     icon : 'error',
    title : 'ERROR!!',
     text :  'Debe iniciar sesión en el sistema'
    }).then((result) => {
         if(result.isConfirmed){
         window.location='./index.php';
        }
    }); </script>";
}
?>