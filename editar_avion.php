<?php
include('./class/class.php');
//creamos el objeto de la clase Alumnos
$avion = new Avion();
if (isset($_POST['grabar']) && $_POST['grabar'] == "si") {
    $avion->editaravion($_POST['id'], $_POST['tip'], $_POST['base']);
    exit();
}
$reg = $avion->get_ida($_GET['id']);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
</head>

<body onload="limpiar();">
    <div class="container">
        <div class="card">
            <div class="card-header bg-info">
                <h3 class="text-white text-center">GESTION DE AVION</h3>
            </div>
            <div class="card-body">
                <form name="form" action="editar_avion.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="id">CODIGO</label>
                            <input type="hidden" name="grabar" value="si">
                            <input type="text" name="id" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="tip">TIPO</label>
                            <input type="text" name="tip" class="form-control" value="<?php echo $reg[0]['tipo']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="base">BASE</label>
                            <input type="text" name="base" class="form-control" value="<?php echo $reg[0]['id_base']; ?>">
                        </div>
                        <div class="col-md-12">
                            <br>
                            <input type="button" class="btn btn-info" value="VOLVER" onclick="window.location='./menua_avion.php'">
                            <input type="submit" class="btn btn-primary" value="EDITAR">
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./sw/dist/sweetalert2.min.js"></script>
    <script src="./js/jquery-3.6.1.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>