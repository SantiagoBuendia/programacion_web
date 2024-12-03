<?php
include("./class/class_log.php");
//creamos el objeto de la clase Login
$nuv = new Nuevo();
//traemos los datos del formulario de login
$correo=$_REQUEST['correo'];
$nombre=$_REQUEST['nombre'];
$contraseña=$_REQUEST['contraseña'];
$fecha_nacimiento=$_REQUEST['fecha_nacimiento'];
$telefono=$_REQUEST['telefono'];
$nuv->registrar($correo,$nombre,$contraseña,$fecha_nacimiento,$telefono);
?>