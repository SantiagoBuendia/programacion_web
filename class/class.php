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
    <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>

    <title>ALUMNOS</title>
</head>

<body>
    <?php
    class Conectar
    {
        public static function conec()
        {
            $host = "localhost";
            $user = "root";
            $pass = "1234";
            $db_name = "bd_aerea";
            //conectarnos a la BD
            $link = mysqli_connect($host, $user, $pass)
                or die("ERROR Al conectar la BD" . mysqli_error($link));
            //seleccionar la BD
            mysqli_select_db($link, $db_name)
                or die("ERROR Al seleccionar la BD" . mysqli_error($link));
            return $link;
        }
    }
    class Personal
    {
        private $pers;

        public function __construct()
        {
            $this->pers = array();
        }
        public function veralp()
        {
            $sql = "select * from persona";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->pers[] = $row;
            }
            return $this->pers;
        }
        public function insertpers($cod, $nom, $base)
        {
            $sql = "insert into persona values('$cod','$nom','$base')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Persona insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua.php';
                }
            });
            </script>";
        }
        //metodo editar
        public function editarpers($id, $nom, $base)
        {
            $sql = "update persona set nombre='$nom',id_base='$base' where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
           <script type='text/javascript'>
           Swal.fire({
              icon : 'success',
              title : 'Operacion Exitosa!!',
              text :  'Datos editados Correctamente'
           }).then((result) => {
               if(result.isConfirmed){
                   window.location='./menua.php';
               }
           });
           </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from persona where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->pers[] = $row;
            }
            return $this->pers;
        }

        //metodo eliminar
        public function eliminarpers($id)
        {
            $sql = "delete from persona where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'El Persona con id $id fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua.php';
       }
   }); </script>
   ";
        }
    }
    class Avion
    {
        private $avion;

        public function __construct()
        {
            $this->avion = array();
        }
        public function veravion()
        {
            $sql = "select * from avion";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->avion[] = $row;
            }
            return $this->avion;
        }
        public function insertavion($cod, $tip, $base)
        {
            $sql = "insert into avion values('$cod','$tip','$base')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Avion insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua_avion.php';
                }
            });
            </script>";
        }
        //metodo editar
        public function editaravion($id, $tip, $base)
        {
            $sql = "update avion set tipo='$tip',id_base='$base' where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
           <script type='text/javascript'>
           Swal.fire({
              icon : 'success',
              title : 'Operacion Exitosa!!',
              text :  'Datos editados Correctamente'
           }).then((result) => {
               if(result.isConfirmed){
                   window.location='./menua_avion.php';
               }
           });
           </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from avion where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->avion[] = $row;
            }
            return $this->avion;
        }

        //metodo eliminar
        public function eliminaravion($id)
        {
            $sql = "delete from avion where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'El Avion con id $id fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua_avion.php';
       }
   }); </script>
   ";
        }
    }
    class Base
    {
        private $base;

        public function __construct()
        {
            $this->base = array();
        }
        public function verbase()
        {
            $sql = "select * from base";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->base[] = $row;
            }
            return $this->base;
        }
        public function insertbase($nom)
        {
            $sql = "insert into base values('$nom')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Base insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua_base.php';
                }
            });
            </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from base where nombre='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->base[] = $row;
            }
            return $this->base;
        }

        //metodo eliminar
        public function eliminarbase($nom)
        {
            $sql = "delete from base where nombre='$nom'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'La Base con el nombre $nom fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua_base.php';
       }
   }); </script>
   ";
        }
    }
    class Vuelo
    {
        private $vuelo;

        public function __construct()
        {
            $this->vuelo = array();
        }
        public function vervuelo()
        {
            $sql = "select * from vuelo";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->vuelo[] = $row;
            }
            return $this->vuelo;
        }
        public function insertvuelo($cod, $org, $dest, $hora, $fecha, $avion)
        {
            $sql = "insert into vuelo values('$cod','$org','$dest','$hora','$fecha','$avion')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Vuelo insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua_vuelo.php';
                }
            });
            </script>";
        }
        //metodo editar
        public function editarvuelo($cod, $org, $dest, $hora, $fecha, $avion)
        {
            $sql = "update vuelo set origen='$org',destino='$dest',hora='$hora',fecha='$fecha',id_avion='$avion' where num_vuelo='$cod'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
           <script type='text/javascript'>
           Swal.fire({
              icon : 'success',
              title : 'Operacion Exitosa!!',
              text :  'Datos editados Correctamente'
           }).then((result) => {
               if(result.isConfirmed){
                   window.location='./menua_vuelo.php';
               }
           });
           </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from vuelo where num_vuelo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->vuelo[] = $row;
            }
            return $this->vuelo;
        }

        //metodo eliminar
        public function eliminarvuelo($id)
        {
            $sql = "delete from vuelo where num_vuelo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'El Vuelo con id $id fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua_vuelo.php';
       }
   }); </script>
   ";
        }
    }
    class Piloto
    {
        private $piloto;

        public function __construct()
        {
            $this->piloto = array();
        }
        public function verpiloto()
        {
            $sql = "select * from piloto";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->piloto[] = $row;
            }
            return $this->piloto;
        }
        public function insertpiloto($cod, $num)
        {
            $sql = "insert into piloto values('$cod','$num')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Piloto insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua_piloto.php';
                }
            });
            </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from piloto where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->piloto[] = $row;
            }
            return $this->piloto;
        }

        //metodo eliminar
        public function eliminarpiloto($id, $num)
        {
            $sql = "delete from piloto where codigo='$id' and num_vuelo='$num'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'El Piloto con id $id fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua_piloto.php';
       }
   }); </script>
   ";
        }
    }
    class Miembro
    {
        private $miembro;

        public function __construct()
        {
            $this->miembro = array();
        }
        public function vermiembro()
        {
            $sql = "select * from miembro";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->miembro[] = $row;
            }
            return $this->miembro;
        }
        public function insertmiembro($cod, $num)
        {
            $sql = "insert into miembro values('$cod','$num')";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
            <script type='text/javascript'>
            Swal.fire({
               icon : 'success',
               title : 'Operacion Exitosa!!',
               text :  'Miembro insertado Correctamente'
            }).then((result) => {
                if(result.isConfirmed){
                    window.location='./menua_miembro.php';
                }
            });
            </script>";
        }

        //metodo para trar el id del alumno

        public function get_ida($id)
        {
            $sql = "select * from miembro where codigo='$id'";
            $res = mysqli_query(Conectar::conec(), $sql);
            if ($row = mysqli_fetch_assoc($res)) {
                $this->miembro[] = $row;
            }
            return $this->miembro;
        }

        //metodo eliminar
        public function eliminarmiembro($id, $num)
        {
            $sql = "delete from miembro where codigo='$id' and num_vuelo='$num'";
            $res = mysqli_query(Conectar::conec(), $sql);
            echo "
   <script type='text/javascript'>
   Swal.fire({
      icon : 'success',
      title : 'Operacion Exitosa!!',
      text :  'El Miembro con id $id fue eliminado Correctamente'
   }).then((result) => {
       if(result.isConfirmed){
           window.location='./menua_miembro.php';
       }
   }); </script>
   ";
        }
    }

    class informacion
    {
        private $informacion;

        public function __construct()
        {
            $this->informacion = array();
        }
        public function ver()
        {
            $sql = "SELECT 
    v.num_vuelo AS NumeroDeVuelo,
    v.origen AS Origen,
    v.destino AS Destino,
    v.fecha AS Fecha,
    v.hora AS Hora,
    a.codigo AS CodigoAvion,
    a.tipo AS TipoAvion,
    p.nombre AS NombrePiloto,
    GROUP_CONCAT(DISTINCT mb.nombre SEPARATOR ', ') AS MiembrosTripulacion
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
GROUP BY 
    v.num_vuelo, v.origen, v.destino, v.fecha, v.hora, a.codigo, a.tipo, p.nombre;";
            $res = mysqli_query(Conectar::conec(), $sql);
            //recorrer la tabla alumnos
            while ($row = mysqli_fetch_assoc($res)) {
                $this->informacion[] = $row;
            }
            return $this->informacion;
        }
    }
    ?>
    <!--  -->
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