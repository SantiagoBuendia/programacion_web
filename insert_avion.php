<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$avion = new Avion();
//enviar los datos al metodo insertar
$avion->insertavion($_REQUEST['cod'],$_REQUEST['tip'],$_REQUEST['base']);
?>