<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$piloto = new Piloto();
//enviar los datos al metodo insertar
$piloto->insertpiloto($_REQUEST['cod'],$_REQUEST['num']);
?>