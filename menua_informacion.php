<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <div>
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
    <div class="container">
      <div class="card">
        <div class="card-header bg-info">
          <h3 class="text-white text-center">GESTION DE INFORMACIÓN <a class="btn btn-outline-light text-end" href="./salir.php">SALIR</a></h3>
        </div>
      </div>
      <?php
      //crear el objeto de la clase información
      $informacion = new informacion();
      $reg = $informacion->ver();
      ?>
      <div class="table-responsive">
        <table id="pers" class="table table-bordered table-striped">
          <thead>
            <tr align="center">
              <th>NÚMERO DE VUELO</th>
              <th>ORIGEN</th>
              <th>DESTINO</th>
              <th>FECHA</th>
              <th>HORA</th>
              <th>CÓDIGO AVION</th>
              <th>TIPO DE AVION</th>
              <th>NOMBRE PILOTO</th>
              <th>MIEMBRO TRIPULACION</th>
              <th>HORAS DE VUELO</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i = 0; $i < count($reg); $i++) {
              echo "<tr>
                <td>" . $reg[$i]['NumeroDeVuelo'] . "</td>
                <td>" . $reg[$i]['Origen'] . "</td>
                <td>" . $reg[$i]['Destino'] . "</td>
                <td>" . $reg[$i]['Fecha'] . "</td>
                <td>" . $reg[$i]['Hora'] . "</td>
                <td>" . $reg[$i]['CodigoAvion'] . "</td>
                <td>" . $reg[$i]['TipoAvion'] . "</td>
                <td>" . $reg[$i]['NombrePiloto'] . "</td>
                <td>" . $reg[$i]['MiembrosTripulacion'] . "</td>
                <td>" . $reg[$i]['horaVuelo'] . "</td>";
            ?>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
  </div>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./sw/dist/sweetalert2.min.js"></script>
    <script src="./js/jquery-3.6.1.min.js"></script>
</body>
</html>
<?php
include('class/class.php'); // Incluir la clase de conexión

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

// Formulario de búsqueda
echo '<form method="POST" action="">
    <label for="num_vuelo">Número de vuelo:</label>
    <input type="text" name="num_vuelo" id="num_vuelo" value="' . $num_vuelo . '">

    <label for="origen">Origen:</label>
    <input type="text" name="origen" id="origen" value="' . $origen . '">

    <label for="destino">Destino:</label>
    <input type="text" name="destino" id="destino" value="' . $destino . '">

    <label for="fecha_desde">Desde:</label>
    <input type="date" name="fecha_desde" id="fecha_desde" value="' . $fecha_desde . '">

    <label for="fecha_hasta">Hasta:</label>
    <input type="date" name="fecha_hasta" id="fecha_hasta" value="' . $fecha_hasta . '">

    <label for="codigo_avion">Código de avión:</label>
    <input type="text" name="codigo_avion" id="codigo_avion" value="' . $codigo_avion . '">

    <label for="tipo_avion">Tipo de avión:</label>
    <input type="text" name="tipo_avion" id="tipo_avion" value="' . $tipo_avion . '">

    <label for="piloto">Nombre de piloto:</label>
    <input type="text" name="piloto" id="piloto" value="' . $piloto . '">

    <button type="submit">Buscar</button>
</form>';

echo '<br>';

// Consulta SQL básica
$query = "SELECT v.num_vuelo, v.origen, v.destino, v.fecha, v.hora, v.id_avion,
                 a.tipo AS tipo_avion, p.nombre AS piloto,
                 GROUP_CONCAT(DISTINCT mb.nombre SEPARATOR ', ') AS MiembrosTripulacion
          FROM vuelo v
          JOIN avion a ON v.id_avion = a.codigo
          JOIN piloto pi ON v.num_vuelo = pi.num_vuelo
          JOIN persona p ON pi.codigo = p.codigo
          LEFT JOIN miembro m ON v.num_vuelo = m.num_vuelo
          LEFT JOIN persona mb ON m.codigo = mb.codigo
          WHERE 1=1
          GROUP BY v.num_vuelo, v.origen, v.destino, v.fecha, 
                v.hora, a.codigo, a.tipo, p.nombre;"; // Condición base para facilitar agregar filtros

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

// Ejecutar la consulta
$result = mysqli_query($conn, $query);

// Verificar si hay resultados
if (mysqli_num_rows($result) > 0) {
    // Mostrar los resultados en una tabla
    echo "<table border='1'>
            <tr>
                <th>Número de vuelo</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Código de avión</th>
                <th>Tipo de avión</th>
                <th>Nombre de piloto</th>
                <th>Miembro de tripulacion</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
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
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
mysqli_close($conn);
?>
</div>


</body>
</html>
