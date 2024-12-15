<?php
include("./class/class_log.php");
//creamos el objeto de la clase Login
$log = new Login();
//traemos los datos del formulario de login
$correo=$_REQUEST['correo'];
$pass=$_REQUEST['passw'];
$log->validar($correo,$pass);
?>