<?php
include("./class/class_log.php");
//creamos el objeto de la clase Login
$nuv = new Nuevo();
//traemos los datos del formulario de login
$correo=$_REQUEST['correo'];
$nombre=$_REQUEST['nom'];
$contraseña=$_REQUEST['passw'];
$fecha_nacimiento=$_REQUEST['fech_na'];
$telefono=$_REQUEST['tel'];
$nuv->registrar($correo,$nombre,$contraseña,$fecha_nacimiento,$telefono);
?>