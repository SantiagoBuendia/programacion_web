<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="csslogin/text.css" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./sw/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
    <title>Recuperación</title>
</head>

<body onload="limpiar();">
    <div class="container">
        <div class="frame">
            <div class="nav">
                <ul>
                    <li class="signin-active"><a>Recuperación de contraseña</a></li>
                </ul>
            </div>
            <div ng-app ng-init="checked = false">
                <form class="form-signin" action="" method="POST">
                    <label for="token">Token de Verificación:</label>
                    <input class="form-styling" type="text" id="token" name="token" required>
                    <br>
                    <label for="nueva_contraseña">Nueva Contraseña:</label>
                    <input class="form-styling" type="password" id="nueva_contraseña" name="nueva_contraseña" required>
                    <br>
                    <button class="btn-signin" type="submit">Actualizar Contraseña</button>
                </form>
            </div>
        </div>
    </div>
    <script src="./sw/dist/sweetalert2.min.js"></script>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/indes.js"></script>
</body>

<?php
// Recuperar el correo enviado desde el formulario
if (isset($_POST['correo_recuperar'])) {
    $correo = $_POST['correo_recuperar'];

    // Conectar a la base de datos
    include('./class/class.php');
    $conexion = Conectar::conec();

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuario WHERE correo = '$correo'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {

        $usuario = $result->fetch_assoc();
        $token = bin2hex(random_bytes(16)); // Generar un token único

        // Guardar el token en la base de datos asociado al correo
        $sql = "UPDATE usuario SET token_recuperacion = '$token' WHERE correo = '$correo'";
        mysqli_query($conexion, $sql);

        // Enviar correo con el enlace de recuperación
        $to = $correo;
        $subject = "Recuperación de contraseña";
        $message = "Tu codigo de verificación es: $token";
        $headers = "From: no-reply@COMPAÑIAAÉREA.com";

        // Usar la función mail() para enviar el correo
        if (mail($to, $subject, $message, $headers)) {
            echo "Se ha enviado un correo con el enlace para recuperar tu contraseña.";
        } else {
            echo "Hubo un problema al enviar el correo.";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
?>

<?php
// Recuperar el token y la nueva contraseña
if (isset($_POST['token']) && isset($_POST['nueva_contraseña'])) {
    $token = $_POST['token'];
    $nueva_contraseña = $_POST['nueva_contraseña'];

    // Conectar a la base de datos
    include('./class/class.php');
    $conexion = Conectar::conec();

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }    

    $sql = "SELECT * FROM usuario WHERE token_recuperacion = '$token'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        $usuario = $result->fetch_assoc();
        $correo_usuario = $usuario['correo'];

        // Actualizar la contraseña en la base de datos
        $update_sql = "UPDATE usuario SET contraseña = '$nueva_contraseña' WHERE correo = '$correo_usuario'";

        if (mysqli_query($conexion, $update_sql)) {
            // Marcar el token como utilizado
            $update_token_sql = "UPDATE usuario SET token_recuperacion = '' WHERE token_recuperacion = '$token'";
            mysqli_query($conexion, $update_token_sql);

            echo "La contraseña ha sido actualizada exitosamente.";
        } else {
            echo "Hubo un problema al actualizar la contraseña.";
        }
    } else {
        echo "El token no es válido o ha expirado.";
    }
}
?>