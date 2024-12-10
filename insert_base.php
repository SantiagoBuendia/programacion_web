<?php
include('./class/class.php');
//crear el objeto de la clase Alumnos
$base = new Base();
//enviar los datos al metodo insertar
$base->insertbase($_REQUEST['nom']);
?>