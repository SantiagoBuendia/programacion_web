<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$miembro = new Miembro();
//enviar los datos al metodo insertar
$miembro->insertmiembro($_REQUEST['cod'],$_REQUEST['num']);
?>