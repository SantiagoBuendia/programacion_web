<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$vuelo = new Vuelo();
//enviar los datos al metodo insertar
$vuelo->insertvuelo($_REQUEST['cod'],$_REQUEST['org'],$_REQUEST['dest'],$_REQUEST['hora'],$_REQUEST['fecha'],$_REQUEST['avion']);
?>