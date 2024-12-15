<?php
// Recuperar el correo enviado desde el formulario
if (isset($_POST['correo_recuperar'])) {
    $correo = $_POST['correo_recuperar'];

    // Conectar a la base de datos
    include('./class/class.php');
    $conexion = Conectar::conec();

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Si el correo existe, generar un token único para la recuperación
        $token = bin2hex(random_bytes(50));  // Genera un token aleatorio

        // Guardar el token en la base de datos asociado al correo
        $sql = "UPDATE usuarios SET token_recuperacion = '$token' WHERE correo = '$correo'";
        mysqli_query($conexion, $sql);

        // Enviar el correo de recuperación con el enlace
        $enlaceRecuperacion = "http://tusitio.com/cambiar_contrasena.php?token=$token";
        $asunto = "Recuperación de contraseña";
        $mensaje = "Haz clic en el siguiente enlace para cambiar tu contraseña: $enlaceRecuperacion";
        $cabeceras = "From: no-reply@tusitio.com";

        // Usar la función mail() para enviar el correo
        if (mail($correo, $asunto, $mensaje, $cabeceras)) {
            echo "Se ha enviado un correo con el enlace para recuperar tu contraseña.";
        } else {
            echo "Hubo un problema al enviar el correo.";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
?>