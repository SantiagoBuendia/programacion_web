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
<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
      <title>GESTIÓN DE INFORMACIÓN</title>
  </head>
  <body onload="limpiar()" ;>
    <div>
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="menua_avion.php">Personal</a>
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
      <div class="container">
        <div class="card">
          <div class="card-header bg-info">
            <h3 class="text-white text-center">GESTIÓN DE INFORMACIÓN <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
          </div>
        </div>
        <?php
        // Obtener la conexión usando la clase
        $conn = Conectar::conec();

        // Obtener los datos del formulario si se ha enviado
        $num_vuelo = isset($_POST['num_vuelo']) ? $_POST['num_vuelo'] : '';
        $origen = isset($_POST['origen']) ? $_POST['origen'] : '';
        $destino = isset($_POST['destino']) ? $_POST['destino'] : '';
        $fecha_desde = isset($_POST['fecha_desde']) ? $_POST['fecha_desde'] : '';
        $fecha_hasta = isset($_POST['fecha_hasta']) ? $_POST['fecha_hasta'] : '';
        $codigo_avion = isset($_POST['codigo_avion']) ? $_POST['codigo_avion'] : '';
        $tipo_avion = isset($_POST['tipo_avion']) ? $_POST['tipo_avion'] : '';
        $piloto = isset($_POST['piloto']) ? $_POST['piloto'] : '';
        $miembro = isset($_POST['miembro']) ? $_POST['miembro'] : '';

        // Formulario de búsqueda
        echo '
        <form method="POST" action="" class="p-3 border rounded shadow bg-light">
          <div class="row g-3">
            <div class="col-md-4">
              <label for="num_vuelo" class="form-label">Número de vuelo:</label>
              <input type="text" name="num_vuelo" class="form-control" value="'.$num_vuelo.'" placeholder="Ingrese número de vuelo">
            </div>
            <div class="col-md-4">
              <label for="origen" class="form-label">Origen:</label>
              <input type="text" name="origen" class="form-control" value="'.$origen.'" placeholder="Ingrese origen">
            </div>
            <div class="col-md-4">
              <label for="destino" class="form-label">Destino:</label>
              <input type="text" name="destino" class="form-control" value="'.$destino.'" placeholder="Ingrese destino">
            </div>
            <div class="col-md-6">
              <label for="fecha_desde" class="form-label">Fecha desde:</label>
              <input type="date" name="fecha_desde" class="form-control" value="'.$fecha_desde.'">
            </div>
            <div class="col-md-6">
              <label for="fecha_hasta" class="form-label">Fecha hasta:</label>
              <input type="date" name="fecha_hasta" class="form-control" value="'.$fecha_hasta.'">
            </div>
            <div class="col-md-4">
              <label for="codigo_avion" class="form-label">Código de avión:</label>
              <input type="text" name="codigo_avion" class="form-control" value="'.$codigo_avion.'" placeholder="Ingrese código">
            </div>
            <div class="col-md-4">
              <label for="tipo_avion" class="form-label">Tipo de avión:</label>
              <input type="text" name="tipo_avion" class="form-control" value="'.$tipo_avion.'" placeholder="Ingrese tipo">
            </div>
            <div class="col-md-4">
              <label for="piloto" class="form-label">Nombre de piloto:</label>
              <input type="text" name="piloto" class="form-control" value="'.$piloto.'" placeholder="Ingrese piloto">
            </div>
            <div class="col-md-4">
              <label for="miembro" class="form-label">Nombre de miembro:</label>
              <input type="text" name="miembro" class="form-control" value="'.$miembro.'" placeholder="Ingrese miembro">
            </div>
          </div>
          <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg"><i class="material-icons">search</i> Buscar</button>
            <button type="reset" class="btn btn-secondary btn-lg"><i class="material-icons">clear</i> Limpiar</button>
          </div>
        </form>
        <br>';

        // Consulta SQL básica
        $query = 
        "SELECT 
          v.num_vuelo,
          v.origen,
          v.destino,
          v.fecha,
          v.hora,
          v.id_avion,
          a.tipo AS tipo_avion,
          GROUP_CONCAT(DISTINCT p.nombre SEPARATOR ', ') AS piloto,
          GROUP_CONCAT(DISTINCT mb.nombre SEPARATOR ', ') AS MiembrosTripulacion, 
          pt.horas_vuelo AS horaVuelo 
          FROM 
              vuelo v
          JOIN 
              avion a ON v.id_avion = a.codigo
          JOIN 
              piloto pt ON v.num_vuelo = pt.num_vuelo
          JOIN 
              persona p ON pt.codigo = p.codigo
          LEFT JOIN 
              miembro m ON v.num_vuelo = m.num_vuelo
          LEFT JOIN 
              persona mb ON m.codigo = mb.codigo
          WHERE 1=1";

        // Añadir filtros a la consulta si es necesario
        if (!empty($num_vuelo)) {
            $query .= " AND v.num_vuelo LIKE '%$num_vuelo%'";
        }
        if (!empty($origen)) {
            $query .= " AND v.origen LIKE '%$origen%'";
        }
        if (!empty($destino)) {
            $query .= " AND v.destino LIKE '%$destino%'";
        }
        if (!empty($fecha_desde)) {
            $query .= " AND v.fecha >= '$fecha_desde'";
        }
        if (!empty($fecha_hasta)) {
            $query .= " AND v.fecha <= '$fecha_hasta'";
        }
        if (!empty($codigo_avion)) {
            $query .= " AND v.id_avion LIKE '%$codigo_avion%'";
        }
        if (!empty($tipo_avion)) {
            $query .= " AND a.tipo LIKE '%$tipo_avion%'";
        }
        if (!empty($piloto)) {
            $query .= " AND p.nombre LIKE '%$piloto%'";
        }
        
        $query .= " GROUP BY 
        v.num_vuelo, v.origen, v.destino, v.fecha, v.hora, a.codigo, a.tipo, p.nombre, pt.horas_vuelo;";

        // Ejecutar la consulta
        $result = mysqli_query($conn, $query);

        // Verificar si hay resultados
        if (mysqli_num_rows($result) > 0) {
            // Mostrar los resultados en una tabla
          echo "
          <div class='table-responsive'>
            <table class='table table-bordered table-striped'>
              <thead>
                <tr align='center'>
                  <th>Número de vuelo</th>
                  <th>Origen</th>
                  <th>Destino</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Código de avión</th>
                  <th>Tipo de avión</th>
                  <th>Nombre de piloto</th>
                  <th>Miembro de tripulacion</th>
                </tr>
              </thead>
              <tbody>";
          while($row = mysqli_fetch_assoc($result)) {
            echo "
                <tr class='align-middle'>
                  <td>" . $row["num_vuelo"] . "</td>
                  <td>" . $row["origen"] . "</td>
                  <td>" . $row["destino"] . "</td>
                  <td>" . $row["fecha"] . "</td>
                  <td>" . $row["hora"] . "</td>
                  <td>" . $row["id_avion"] . "</td>
                  <td>" . $row["tipo_avion"] . "</td>
                  <td>" . $row["piloto"] . "</td>
                  <td>" . $row["MiembrosTripulacion"] . "</td>
                </tr>";
          }
          echo "
              </tbody>
            </table>
          </div>";
        } else {
          echo "
          <script type='text/javascript'>
            Swal.fire({
              icon : 'info',
              title : 'Resultado filtro',
              text : 'No se encontraron resultados'
            });
          </script>";
        }

        // Cerrar la conexión
        mysqli_close($conn);
        ?>
      </div>
    </div>
  </body>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <script src="./sw/dist/sweetalert2.min.js"></script>
  <script src="./js/jquery-3.6.1.min.js"></script>
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