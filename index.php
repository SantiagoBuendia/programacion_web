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
        <title>COMPAÑIA AÉREA</title>
    </head>

    <body onload="limpiar();">
        <div class="container">
            <div class="frame">
                <div class="nav">
                    <ul>
                        <li class="signin-active"><a class="btn">Iniciar sesión</a></li>
                        <li class="signup-inactive"><a class="btn">Registrarse</a></li>
                    </ul>
                </div>
                <div ng-app ng-init="checked = false">
                <form class="form-signin" action="verificar.php" method="post" name="form">
                        <label for="correo">CORREO</label>
                        <input class="form-styling" type="text" name="correo" class="form-control" placeholder="ejemplo@correo.com">
                        <label for="passw">CONTRASEÑA</label>
                        <input class="form-styling" type="password" name="passw" class="form-control" placeholder="**********">
                        <input type="submit" class="btn-signin" value="INGRESAR" onclick="validarInicioSesion(event)">
                    </form>
                    <form class="form-signup" action="registrar.php" method="post">
                        <label for="correo">CORREO</label>
                        <input class="form-styling" type="text" name="correo" placeholder="ejemplo@correo.com"/>
                        <label for="nom">NOMBRE</label>
                        <input class="form-styling" type="text" name="nom" placeholder="Digite el nombre"/>
                        <label for="passw">CONTRASEÑA</label>
                        <input class="form-styling" type="text" name="passw" placeholder="**********"/>
                        <label for="fech_na">FECHA DE NACIMIENTO</label>
                        <input class="form-styling field-date" type="date" name="fech_na"/>
                        <label for="tel">TELÉFONO</label>
                        <input class="form-styling" type="text"minlength="8" maxlength="10" pattern="[0-9]+"  name="tel" placeholder="Digite el teléfono"/>
                        <input type="submit" class="btn-signin" value="REGISTRAR" onclick="validarRegistroU(event)">
                    </form>
                </div>
                <div class="forgot">
                    <a href="#">Olvidó su contraseña?</a>
                </div>
            </div>
        </div>
        <script src="./sw/dist/sweetalert2.min.js"></script>
        <script src="./js/jquery-3.6.1.min.js"></script>
        <script src="./js/indes.js"></script>
    </body>
</html>