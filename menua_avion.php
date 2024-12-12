<?php
session_start();
$inn = 500;
if (isset($_SESSION['timeout'])) {
    $_session_life = time() - $_SESSION['timeout'];
    if ($_session_life > $inn) {
        session_destroy();
        header("location:./index.php");
    }
}
$_SESSION['timeout'] = time();
include('./class/class.php');
if ($_SESSION['usuario']) {
?>
    <!doctype html>
    <html>

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">-->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
        <title>Avion</title>
    </head>

    <body onload="limpiar()" ;>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="menua.php">Personal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="menua_avion.php">Avion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menua_base.php">Base</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menua_vuelo.php">Vuelo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menua_piloto.php">Piloto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="menua_miembro.php">Miembro</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white text-center">GESTION DE AVION <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
                </div>
                <div class="card-body">
                    <form name="form" action="insert_avion.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cod">CODIGO</label>
                                <input type="text" name="cod" class="form-control" placeholder="DIGITE EL CODIGO">
                            </div>
                            <div class="col-md-6">
                                <label for="tip">TIPO</label>
                                <input type="text" name="tip" class="form-control" placeholder="DIGITE EL TIPO">
                            </div>
                            <div class="col-md-6">
                                <label for="base">BASE</label>
                                <input type="text" name="base" class="form-control" placeholder="DIGITE LA BASE">
                            </div>
                            <div class="col-md-12">
                                <br>
                                <input type="submit" class="btn btn-primary" value="REGISTRAR AVION" onclick="validar()">
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        //crear el objeto de la clas Alumnos
        $avion = new Avion();
        $reg = $avion->veravion();
        ?>
        <div class="table-responsive">
            <table id="avion" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th>CODIGO</th>
                        <th>TIPO</th>
                        <th>BASE MANTENIMIENTO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($reg); $i++) {
                        echo "<tr>
        <td>" . $reg[$i]['codigo'] . "</td>
        <td>" . $reg[$i]['tipo'] . "</td>
        <td>" . $reg[$i]['id_base'] . "</td>";
                    ?>
                        <td align='center'>
                            <button class='btn btn-warning' onclick=window.location="./editar_avion.php?id=<?php echo $reg[$i]['codigo']; ?>">
                                <span class="material-symbols-outlined">edit_square</span>
                                <button class='btn btn-primary' onclick="eliminar('eliminar_avion.php?id=<?php echo $reg[$i]['codigo']; ?>')">
                                    <span class="material-symbols-outlined">delete_sweep</span>
                        </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
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
<?php
} else {
    $_SESSION['usuario'] = NULL;
    echo "
    <script type='text/javascript'>
     Swal.fire({
     icon : 'error',
    title : 'ERROR!!',
     text :  ' Debe iniciar Session en el Sistema'
    }).then((result) => {
         if(result.isConfirmed){
         window.location='./index.php';
        }
    }); </script>";
}
?>