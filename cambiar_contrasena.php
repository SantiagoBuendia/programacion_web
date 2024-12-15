<?php
// Recuperar el token de la URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Conectar a la base de datos
    include('./class/class.php');
    $conexion = Conectar::conec();

    // Verificar si el token es válido
    $sql = "SELECT * FROM usuarios WHERE token_recuperacion = '$token'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Mostrar el formulario para cambiar la contraseña
        echo '
        <form method="post" action="cambiar_contrasena.php">
            <input type="password" name="nueva_contrasena" placeholder="Nueva Contraseña" required>
            <input type="submit" value="Cambiar Contraseña">
        </form>
        ';
        
        // Si el formulario es enviado, cambiar la contraseña
        if (isset($_POST['nueva_contrasena'])) {
            $nueva_contrasena = $_POST['nueva_contrasena'];

            // Actualizar la contraseña en la base de datos
            $sql = "UPDATE usuarios SET passw = '$nueva_contrasena', token_recuperacion = NULL WHERE token_recuperacion = '$token'";
            if (mysqli_query($conexion, $sql)) {
                echo "Contraseña cambiada con éxito.";
            } else {
                echo "Hubo un problema al cambiar la contraseña.";
            }
        }
    } else {
        echo "El token no es válido o ha expirado.";
    }
}
?>
