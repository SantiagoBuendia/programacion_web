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
        <title>Personal</title>
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

        $vuelo = new Vuelo();
        $lstvuelo = $vuelo->vervueloactivo();

        $perPiloto = new Personal();
        $lstperPiloto = $perPiloto->verPilo_Miem('piloto');

        ?>
        <div class="container">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white text-center">GESTIÓN DE PILOTO <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
                </div>
                <div class="card-body">
                    <form  action="insert_piloto.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="piloto">Selecciona un piloto:</label>
                                <select name="cod" class="form-select">
                                <option value=""> Selecciona un piloto </option>
                                <?php
                                        for ($i = 0; $i < count($lstperPiloto); $i++) {
                                            echo "<option value='" . $lstperPiloto[$i]['codigo']. "'>" . $lstperPiloto[$i]['PerPiloto'] ./*$lstperPiloto[$i]['codigo'] .*/ "</option>";
                                        }
                                    ?>
                             </select>
                            </div>
                            <div class="col-md-6">
                                <label for="num">NÚMERO DE VUELO</label>
                                <select name="num" class="form-select">
                                    <option value="" disabled selected>SELECCIONE NÚMERO DE VUELO</option>
                                    <?php
                                        for ($i = 0; $i < count($lstvuelo); $i++) {
                                            echo "<option value='" . $lstvuelo[$i]['num_vuelo']. "'>" . $lstvuelo[$i]['num_vuelo'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="horas">HORAS DE VUELO</label>
                                <input type="number" name="horas" class="form-control" placeholder="DIGITE LAS HORAS DE VUELO">
                            </div>
                            <div class="col-md-12">
                                <br>
                                <input type="submit" class="btn btn-primary" value="REGISTRAR VUELO DEL PILOTO" >
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        //crear el objeto de la clas Alumnos
        $piloto = new Piloto();
        $reg = $piloto->verpiloto();

        ?>
        <div class="table-responsive">
            <table id="pers" class="table table-bordered table-striped">
                <thead>
                    <tr align="center">
                        <th>CÓDIGO</th>
                        <th>HORAS DE VUELO</th>
                        <th>NÚMERO DE VUELO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($reg); $i++) {
                        echo "<tr>
                            <td>" . $reg[$i]['codigo'] . "</td>
                            <td>" . $reg[$i]['horas_vuelo'] . "</td>
                            <td>" . $reg[$i]['num_vuelo'] . "</td>";
                            
                    ?>
                            <td align='center'>
                                <button class='btn btn-primary' onclick="eliminar('eliminar_piloto.php?id=<?php echo $reg[$i]['codigo']; ?>&num_vuelo=<?php echo $reg[$i]['num_vuelo']; ?>')">
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
            text :  ' Debe iniciar Session en el Sistema'
        }).then((result) => {
            if(result.isConfirmed){
            window.location='./index.php';
        }
    }); </script>";
}
?>