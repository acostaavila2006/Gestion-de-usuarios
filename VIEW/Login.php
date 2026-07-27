<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/form.css">
    <title>Login</title>
</head>

<body>
    <div class="CampoForm">
        <form method="post">
            <img src="../IMG/profile.png" alt="...">
            <?php
            include_once('../MODEL/SQL/Conexion.php');
            include_once('../CONTROLLER/InicioSesion.php');
            ?>
            <div class="campos">
                <input class="usuario" type="text" placeholder="Usuario" name="Usuario"><br>
                <input class="Pass" type="password" placeholder="Contraseña" name="Pass"><br>
            </div>
            <input class="Ingresar" type="submit" value="Ingresar" name="Ingresar">
        </form>
    </div>
</body>
</html>