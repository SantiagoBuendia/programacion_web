<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$pers = new Personal();
//enviar los datos al metodo insertar
$pers->insertpers($_REQUEST['cod'],$_REQUEST['nom'],$_REQUEST['base'],$_REQUEST['tip_per'],$_REQUEST['h_vuelo']);
?>