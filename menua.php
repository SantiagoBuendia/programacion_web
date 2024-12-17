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
      //crear el objeto de la clase base
      $base = new Base();
      $lstbase = $base->verbase();
    ?>
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="text-white text-center">GESTIÓN DE PERSONAL <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
        </div>
        <div class="card-body">
          <form name="form" action="insertp.php" method="post">
            <div class="row">
              <div class="col-md-6">
                <label for="cod">CÓDIGO (CÉDULA)</label>
                <input type="number" name="cod" class="form-control" placeholder="DIGITE EL CODIGO" in="1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)">
              </div>
              <div class="col-md-6">
                <label for="nom">NOMBRE</label>
                <input type="text" name="nom" class="form-control" placeholder="DIGITE EL NOMBRE">
              </div>
              <div class="col-md-6">
                <label for="base">BASE DE REGRESO</label>
                <select name="base" class="form-select">
                    <option value="" disabled selected>SELECCIONE UNA BASE</option>
                    <?php
                        for ($i = 0; $i < count($lstbase); $i++) {
                            echo "<option value='" . $lstbase[$i]['nombre']. "'>" . $lstbase[$i]['nombre'] . "</option>";
                        }
                    ?>
                </select>                                
              </div>
              <div class="col-md-6">
                <label>TIPO DE PERSONAL</label>
                <div class="form-control">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tip_per" id="miembro" value="miembro" onclick="activarHorasVuelo()">
                    <label class="form-check-label" for="miembro">Miembro</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tip_per" id="piloto" value="piloto" onclick="activarHorasVuelo()">
                    <label class="form-check-label" for="piloto">Piloto</label>
                  </div>
                </div>
              </div>
              <div class="col-md-6" id="horas_vuelo_container" style="display:none;">
                <label for="h_vuelo">HORAS DE VUELO</label>
                <input type="number" name="h_vuelo" class="form-control" placeholder="DIGITE LAS HORAS DE VUELO" in="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
              </div>
              <div class="col-md-12">
                <br>
                <input type="submit" class="btn btn-primary" value="REGISTRAR PERSONAL" onclick="validarCampos(event,'personal'); ">
              </div>
          </form>
        </div>
      </div>
    </div>
    <?php
    //crear el objeto de la clase personal
    $pers = new Personal();
    $reg = $pers->veralp();
    $das = $pers->veralpinc();
    ?>
    <div class="table-responsive">
      <table id="pers" class="table table-bordered table-striped">
        <thead>
        <tr align="center">
                <th colspan="6">Personal en estado activo</th>
            </tr>
          <tr align="center">
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>BASE DE REGRESO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($reg); $i++) {
            echo "<tr class='align-middle'>
              <td>" . $reg[$i]['codigo'] . "</td>
              <td>" . $reg[$i]['nombre'] . "</td>
              <td>" . $reg[$i]['id_base'] . "</td>";
          ?>
              <td class='d-flex align-items-center justify-content-evenly'>
                <button class='btn btn-warning d-flex align-items-center justify-content-center' onclick=window.location="./editarp.php?id=<?php echo $reg[$i]['codigo']; ?>">
                  <span class="material-symbols-outlined">edit_square</span>
                  <button class='btn btn-primary' onclick="eliminar('eliminarp.php?id=<?php echo $reg[$i]['codigo']; ?>')">
                    <span class="material-symbols-outlined">delete_sweep</span>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <table id="pers" class="table table-bordered table-striped">
        <thead>
        <tr align="center">
                <th colspan="6">Personal en estado inactivo</th>
            </tr>
          <tr align="center">
            <th>CÓDIGO</th>
            <th>NOMBRE</th>
            <th>BASE DE REGRESO</th>
          </tr>
        </thead>
        <tbody>
          <?php
          for ($i = 0; $i < count($das); $i++) {
            echo "<tr class='align-middle'>
              <td>" . $das[$i]['codigo'] . "</td>
              <td>" . $das[$i]['nombre'] . "</td>
              <td>" . $das[$i]['id_base'] . "</td>";
          ?>
              <td class='d-flex align-items-center justify-content-evenly'>
                <button class='btn btn-warning d-flex align-items-center justify-content-center' onclick=window.location="./editarp.php?id=<?php echo $das[$i]['codigo']; ?>">
                  <span class="material-symbols-outlined">edit_square</span>
                  <button class='btn btn-primary' onclick="eliminar('eliminarp.php?id=<?php echo $das[$i]['codigo']; ?>')">
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
      });
    </script>";
}
?>
