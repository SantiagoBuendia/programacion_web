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
                    $pass = "123456";
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
                    $personal = new Personal();
                    $personalExistente = $personal->get_ida($cod);
                    if(!empty($personalExistente)){
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
                    }else{
                        $sql = "insert into persona values('$cod','$nom','$base')";
                        $res = mysqli_query(Conectar::conec(), $sql);
                        echo "s
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

                // Metodo ver pilotos o miembros
                // public function verPilo_Miem($clase)
                // {
                //     if($clase == 'piloto'){
                //         $sql = "select codigo, concat(codigo, ', ', pe.nombre) as 'PerPiloto'
                //                 from persona
                //                 where perfil = 'piloto";
                //     }else{
                //         $sql = "select codigo, concat(codigo, ', ', pe.nombre) as 'PerPiloto'
                //                 from persona
                //                 where perfil = 'miembro";
                //     }
                //     $res = mysqli_query(Conectar::conec(), $sql);
                //     while ($row = mysqli_fetch_assoc($res)) {
                //         $this->pers[] = $row;
                //     }
                //     return $this->pers;
                // }
            }
            class Avion
            {
                private $avion;

                public function __construct()
                {
                    $this->avion = array();
                }
                //metodo mostrar todos los aviones
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
                //metodo insertar avión
                public function insertavion($cod, $tip, $base)
                {
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
                    }else{
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
                    }else{
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
                public function insertpiloto($cod, $num, $horas)
                {
                    $sql = "insert into piloto values('$cod','$num','$horas')";
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