<!doctype html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
        <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
        <title>COMPAÑIA AÉREA</title>
    </head>

    <body>
        <?php
 class Conectar
 {
     public static function conec()
     {
         $host = "localhost";
         $user = "root";
         $pass = "";
         $db_name = "bd_aereas";
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
                    $sql = "select * from persona where activo=1";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->pers[] = $row;
                    }
                    return $this->pers;
                }
                public function veralpinc(){
                    $this->persinc = array();
                    $sql="SELECT * FROM persona where activo=0";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->persinc[] = $row;
                    }
                    return $this->persinc;
                }
                    public function insertpers($cod, $nom, $base, $tipo_per,$h_vuelo)
                    {
                        // Escapar las variables para evitar inyecciones SQL
                        $con = Conectar::conec();

                        
                        // Verificar si el código ya existe
                        $personal = new Personal();
                        $personalExistente = $personal->get_ida($cod);
                        if (!empty($personalExistente)) {
                            echo "
                                <script type='text/javascript'>
                                    Swal.fire({
                                        icon: 'error',
                                        title: '¡Error!',
                                        text: 'El código ya existe. No se realizó la inserción.'
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location='./menua.php';
                                        }
                                    });
                                </script>";
                        } else {
                            // Verificar si los campos no están vacíos
                            if (empty($cod) || empty($nom) || empty($base) || empty($tipo_per)) {
                                echo "Por favor, complete todos los campos.";
                                exit;
                            }

                            // Insertar en la base de datos
                            $sql = "INSERT INTO persona (codigo, nombre, id_base, perfil) VALUES ('$cod', '$nom', '$base', '$tipo_per')";
                            $res = mysqli_query($con, $sql);
                            // Verificar si la inserción fue exitosa
                            if ($res) {
                                echo "
                                    <script type='text/javascript'>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Operación Exitosa!!',
                                            text: 'Persona insertada correctamente'
                                        }).then((result) => {
                                            if(result.isConfirmed){
                                                window.location='./menua.php';
                                            }
                                        });
                                    </script>";
                            } else {
                                echo "Error al insertar la persona: " . mysqli_error($con);
                            }
                        }
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

                //metodo para obtener datos por el codigo del personal
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
                    $sql = "update persona set activo=0 where codigo='$id'";
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


                public function verPilo_Miem($clase)
                {
                    $this->pers = [];
                    if ($clase == 'piloto') {
                        $sql = "SELECT codigo, CONCAT(codigo, ', ', pe.nombre) AS 'PerPiloto'
                                FROM persona pe
                                WHERE perfil = 'piloto'";
                    }if ($clase == 'miembro'){
                        $sql = "SELECT codigo, CONCAT(codigo, ', ', pe.nombre) AS 'PerPiloto'
                                FROM persona pe
                                WHERE perfil = 'miembro'";
                    }
                
                    $res = mysqli_query(Conectar::conec(), $sql);
                
                    // Verificar si la consulta fue exitosa
                    if ($res === false) {
                        // Mostrar el error si la consulta falla
                        die('Error en la consulta SQL: ' . mysqli_error(Conectar::conec()));
                    }
                
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->pers[] = $row;
                    }
                    return $this->pers;
                }
                
            }
            class Avion
            {
                private $avion;

                public function __construct()
                {
                    $this->avion = array();
                }
                //metodo mostrar todos los aviones
                public function veravionactivo()
                {
                    $sql = "select * from avion where activo=1";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->avion[] = $row;
                    }
                    return $this->avion;
                }
                public function veravioninactivo()
                {
                    $this->avion = [];
                    $sql = "select * from avion where activo=0";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->avion[] = $row;
                    }
                    return $this->avion;
                }
                //metodo insertar avión
                public function insertavion($cod, $tip, $base)
                {
                    $con = Conectar::conec();
                    $avion = new Avion();
                    $avionExistente = $avion->get_ida($cod);

                    if (!empty($avionExistente)) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: 'El código del avión ya existe. No se realizó la inserción.'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location='./menua_avion.php';
                                    }
                                });
                            </script>";
                            return;
                    }
                    if(empty($cod) || empty($tip)||empty($base )) {
                        echo "Por favor, complete todos los campos.";
                        exit; 
                    }
                        $sql = "insert into avion(codigo,tipo,id_base,activo) values('$cod','$tip','$base',1)";
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                            echo "
                                <script type='text/javascript'>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Operación Exitosa!!',
                                        text: 'Avion insertado correctamente'
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location.replace('./menua_avion.php');
                                        }
                                    });
                                </script>";
                        } else {
                            echo "Error al insertar el piloto: " . mysqli_error($con);
                        }
                }
                //metodo editar avión
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
                //metodo para obtener datos por el codigo del avión
                public function get_ida($id)
                {
                    $sql = "select * from avion where codigo='$id'";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    if ($row = mysqli_fetch_assoc($res)) {
                        $this->avion[] = $row;
                    }
                    return $this->avion;
                }
                //metodo eliminar avion
                public function eliminaravion($id)
                {
                    $sql = "update avion set activo=0  where codigo='$id'";
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
                    $sql = "select * from base where activo=1";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->base[] = $row;
                    }
                    return $this->base;
                }

                public function verbaseinactiva()
                {
                    $this->baseinactiva = array();
                    $sql = "SELECT * from base where activo=0";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->baseinactiva[] = $row;
                    }
                    return $this->baseinactiva;
                }

                
                public function insertbase($nom)
                {
                    // Escapar el valor para prevenir inyección SQL
                    $nom = mysqli_real_escape_string(Conectar::conec(), $nom);
                
                    $base = new Base();
                    $baseExistente = $base->get_ida($nom);
                
                    if (!empty($baseExistente)) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: 'El nombre de la base ya existe. No se realizó la inserción.'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location='./menua_base.php';
                                    }
                                });
                            </script>";
                    } else {
                        // Verificar si la base de datos es conectada correctamente
                        $sql = "INSERT INTO base (nombre) VALUES ('$nom')";
                        $res = mysqli_query(Conectar::conec(), $sql);
                
                        if ($res) {
                            echo "
                                <script type='text/javascript'>
                                    Swal.fire({
                                        icon : 'success',
                                        title : 'Operación Exitosa!!',
                                        text :  'Base insertada correctamente'
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location='./menua_base.php';
                                        }
                                    });
                                </script>";
                        } else {
                            echo "Error al insertar la base: " . mysqli_error(Conectar::conec());
                        }
                    }
                }

                //metodo para obtener datos por el nombre de la base
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
                    $sql = "update base set activo=0 where nombre='$nom'";
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
                public function vervueloactivo()
                {
                    $sql = "select * from vuelo where activo=1";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->vuelo[] = $row;
                    }
                    return $this->vuelo;
                }
                public function vervueloinactivo()
                {
                    // Inicializar la propiedad de vuelos inactivos
                    $this->vueloInactivo = array();
                    $sql = "SELECT * FROM vuelo WHERE activo = 0";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    // Recorrer los resultados y almacenarlos en la propiedad $vueloInactivo
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->vueloInactivo[] = $row;
                    }
                    return $this->vueloInactivo;
                }
                public function insertvuelo($cod, $org, $dest, $hora, $fecha, $avion)
                {
                    $con = Conectar::conec();
                    $vuelo = new Vuelo();
                    $vueloExistente = $vuelo->get_ida($cod);
                    if (!empty($vueloExistente)) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: 'El código del vuelo ya existe. No se realizó la inserción.'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location='./menua_vuelo.php';
                                    }
                                });
                            </script>";
                    }else{
                        if(empty($cod)|| empty($org)||empty($dest)|| empty($hora)|| empty($fecha) ||empty($avion)){
                            echo "Por favor, complete todos los campos.";
                            exit; 
                        }
                        $sql = "INSERT into vuelo (num_vuelo,origen,destino,hora,fecha,id_avion,activo)values('$cod','$org','$dest','$hora','$fecha','$avion',1)";
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                            echo "
                                <script type='text/javascript'>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Operación Exitosa!!',
                                        text: 'Vuelo insertado correctamente'
                                    }).then((result) => {
                                        if(result.isConfirmed){
                                            window.location='./menua_vuelo.php';
                                        }
                                    });
                                </script>";
                        } else {
                            echo "Error al insertar la persona: " . mysqli_error($con);
                        }
                    }
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

                //metodo para obtener datos por el codigo del vuelo
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
                    $sql = "update vuelo set activo=0  where num_vuelo='$id'";
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

            

                public function insertpiloto($cod, $num, $horas) {
                    // Conectar a la base de datos
                    $con = Conectar::conec();
                    $piloto = new Piloto();
                
                    // Verificar si ya existe un piloto registrado para el vuelo
                    $pilotoExistente = $piloto->get_ida($cod, $num);  // Asumiendo que 'get_ida' recibe ambos parámetros
                    if (!empty($pilotoExistente)) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: 'El vuelo ya tiene un piloto asignado.'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.replace('./menua_piloto.php');
                                    }
                                });
                            </script>";
                        return;
                    }
                
                    // Validar que los campos no estén vacíos
                    if(empty($cod) || empty($num) || empty($horas)) {
                        echo "Por favor, complete todos los campos.";
                        exit; 
                    }
                
                    // Insertar el piloto en la base de datos
                    $sql = "INSERT INTO piloto (codigo, horas_vuelo, num_vuelo) VALUES ('$cod', '$horas', '$num')";
                    $res = mysqli_query($con, $sql);
                
                    // Verificar si la inserción fue exitosa
                    if ($res) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Operación Exitosa!!',
                                    text: 'Piloto insertado correctamente'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.replace('./menua_vuelo.php');
                                    }
                                });
                            </script>";
                    } else {
                        echo "Error al insertar el piloto: " . mysqli_error($con);
                    }
                }
                

                //metodo para obtener datos por el codigo del piloto
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
                    $con = Conectar::conec();
                    $miembro = new miembro();
                    // Verificar si ya existe un miembro registrado para el vuelo
                    $miembroExistente= $miembro->get_ida($cod,$num);
                    if (!empty($miembroExistente)) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'error',
                                    title: '¡Error!',
                                    text: 'El miembro ya tiene un piloto asignado.'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.replace('./menua_piloto.php');
                                    }
                                });
                            </script>";
                        return;
                    }
                    if(empty($cod) || empty($num) ) {
                        echo "Por favor, complete todos los campos.";
                        exit; 
                    }
                    $sql = "INSERT into miembro(codigo,num_vuelo) values('$cod','$num')";
                    $res = mysqli_query($con, $sql);
                    if ($res) {
                        echo "
                            <script type='text/javascript'>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Operación Exitosa!!',
                                    text: 'Miembro insertado correctamente'
                                }).then((result) => {
                                    if(result.isConfirmed){
                                        window.location.replace('./menua_miembro.php');
                                    }
                                });
                            </script>";
                    } else {
                        echo "Error al insertar el piloto: " . mysqli_error($con);
                    }
                }

                //metodo para obtener datos por el codigo del miembro
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
                        GROUP_CONCAT(DISTINCT mb.nombre SEPARATOR ', ') AS MiembrosTripulacion, 
                        pt.hora_vuelo AS horaVuelo 
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
                            v.num_vuelo, v.origen, v.destino, v.fecha, v.hora, a.codigo, a.tipo, p.nombre, pt.hora_vuelo;";
                    $res = mysqli_query(Conectar::conec(), $sql);
                    //recorrer la tabla alumnos
                    while ($row = mysqli_fetch_assoc($res)) {
                        $this->informacion[] = $row;
                    }
                    return $this->informacion;
                }
            }
        ?>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <script src="./sw/dist/sweetalert2.min.js"></script>
        <script src="./js/jquery-3.6.1.min.js"></script>
    </body>
</html>
