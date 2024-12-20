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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
        <title>Avión</title>
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
                            <a class="nav-link active" aria-current="page" href="menua_avion.php">Avión</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="menua_informacion.php">Información</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        //crear el objeto de la clase base
        $base = new Base();
        $lstbase = $base->verbase();
        ?>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white text-center">GESTIÓN DE AVIÓN <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
                </div>
                <div class="card-body">
                    <form name="form" action="insert_avion.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cod">CÓDIGO</label>
                                <input type="text" name="cod" class="form-control" placeholder="DIGITE EL CÓDIGO" pattern="^[A-Za-z]{3}[0-9]{3}$">
                            </div>
                            <div class="col-md-6">
                                <label for="tip">TIPO</label>
                                <input type="text" name="tip" class="form-control" placeholder="DIGITE EL TIPO">
                            </div>
                            <div class="col-md-6">
                                <label for="base">BASE DE MANTENIMIENTO</label>
                                <select name="base" class="form-select">
                                    <option value="" disabled selected>SELECCIONE UNA BASE</option>
                                    <?php
                                        for ($i = 0; $i < count($lstbase); $i++) {
                                            echo "<option value='" . $lstbase[$i]['nombre']. "'>" . $lstbase[$i]['nombre'] . "</option>";
                                        }
                                    ?>
                                </select>                                
                            </div>
                            <div class="col-md-12">
                                <br>
                            <input type="submit" class="btn btn-primary" value="REGISTRAR AVIÓN" onclick="validarCampos(event,'avion')">
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        //crear el objeto de la clase Avión
        $avion = new Avion();
        $reg = $avion->veravion();
        ?>
        <div class="table-responsive">
            <table id="avion" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th>CÓDIGO</th>
                        <th>TIPO</th>
                        <th>BASE MANTENIMIENTO</th>
                        <th>OPCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($reg); $i++) {
                        echo "<tr class='align-middle'>
                            <td>" . $reg[$i]['codigo'] . "</td>
                            <td>" . $reg[$i]['tipo'] . "</td>
                            <td>" . $reg[$i]['id_base'] . "</td>";
                    ?>
                            <td class='d-flex align-items-center justify-content-evenly'>
                                <button class='btn btn-warning d-flex align-items-center justify-content-center' onclick=window.location="./editar_avion.php?id=<?php echo $reg[$i]['codigo']; ?>">
                                    <span class="material-symbols-outlined">edit_square</span>
                                <button class='btn btn-primary d-flex align-items-center justify-content-center' onclick="eliminar('eliminar_avion.php?id=<?php echo $reg[$i]['codigo']; ?>')">
                                    <span class="material-symbols-outlined">delete_sweep</span>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <script src="./sw/dist/sweetalert2.min.js"></script>
        <script src="./js/jquery-3.6.1.min.js"></script>
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
            text : 'Debe iniciar sesión en el sistema'
        }).then((result) => {
            if(result.isConfirmed){
            window.location='./index.php';
        }
    }); </script>";
}
?>