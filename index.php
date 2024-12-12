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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script type="text/javascript" language="Javascript" src="./js/funciones.js"></script>
    <link href="css/text.css" rel='stylesheet' type='text/css'>
    <title>LOGIN DE COMPAÑIA AEREA</title>
</head>

<body onload="limpiar();">
    <div class="container">
        <div class="frame">
            <div class="nav">
                <ul class"links">
                    <li class="signin-active"><a class="btn">Sign in</a></li>
                    <li class="signup-inactive"><a class="btn">Sign up </a></li>
                </ul>
            </div>
            <div ng-app ng-init="checked = false">
                <form class="form-signin" action="verificar.php" method="post" name="form">
                    <label for="user">CORREO</label>
                    <input class="form-styling" type="text" name="user" class="form-control" placeholder="DIGITE EL CORREO" required>
                    <label for="passw">PASSWORD</label>
                    <input class="form-styling" type="password" name="passw" class="form-control" placeholder="DIGITE EL PASSWORD" required>
                    <div class="btn-animate">
                        <input type="submit" class="btn-signin" value="INGRESAR">
                    </div>
                </form>

                <form class="form-signup" action="registrar.php" method="post">
                    <label for="correo">CORREO</label>
                    <input class="form-styling" type="text" name="correo" placeholder="Diguite el correo" />
                    <label for="nombre">NOMBRE</label>
                    <input class="form-styling" type="text" name="nombre" placeholder="Diguite el nombre" required />
                    <label for="contraseña">Password</label>
                    <input class="form-styling" type="text" name="contraseña" placeholder="Diguite la contraseña" required />
                    <label for="fecha_nacimiento">FECHA DE NACIMIENTO</label>
                    <input class="form-styling" type="date" name="fecha_nacimiento" required />
                    <label for="telefono">TELEFONO</label>
                    <input class="form-styling" type="text"minlength="8" maxlength="10" pattern="[0-9]+"  name="telefono" placeholder="Digite el telefono" required />
                    <input type="submit" class="btn-signin" value="REGISTRAR" >
                </form>

            </div>

            <div class="forgot">
                <a href="#">Forgot your password?</a>
            </div>
    </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>-->
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./sw/dist/sweetalert2.min.js"></script>
    <script src="./js/jquery-3.6.1.min.js"></script>
    <script src="./js/indes.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
