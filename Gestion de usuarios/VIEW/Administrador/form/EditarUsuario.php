<?php
$ID = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/formulario.css">
    <link rel="stylesheet" href="../../../CSS/Administrador/form/EditarUser.css">
    <title>Editar usuario</title>
</head>

<body>
    <div class="CampoForm">

        <form method="post">
            <?php
            include('../../../MODEL/SQL/Conexion.php');
            $sql = $Conexion->query("SELECT * FROM Gestion_usuarios WHERE id='$ID'");
            include('../../../CONTROLLER/EditarUsuario.php');


            while ($mostrar = $sql->fetch_object()) { ?>
                <h1>Editar usuario</h1>

                <div class="campos">
                    <input type="text" placeholder="Nombre" name="Nombre" value="<?= $mostrar->Nombre ?>" required><br>
                    <input type="text" placeholder="Apellido" name="Apellido" value="<?= $mostrar->Apellido ?>" required><br>
                    <input type="email" placeholder="Email" name="Email" value="<?= $mostrar->Email ?>" required><br>
                    <input type="password" placeholder="Contraseña" name="Pass" value="<?= $mostrar->Pass ?>" required><br>
                </div>
                <div class="campos">
                    <label>Rol:</label>
                    <select name="Rol" required>
                        <option selected disabled>
                            <?php
                            switch ($mostrar->Rol) {
                                case '1':
                                    print "Administrador";
                                    break;
                                case '2':
                                    print "Supervisor";
                                    break;
                                case '3':
                                    print "Funcionario";
                                    break;
                            }
                            ?>
                        </option>
                        <option value="1">Administrador</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Funcionario</option>
                    </select><br>
                </div>
                <input class="Ingresar" type="submit" value="Cambiar" name="Cambiar">
                <button type="button" onclick="window.location.href='../GestionUsuarios.php'">Volver</button>
            <?php
            }
            ?>
        </form>

    </div>
    <script src="../../../CONTROLLER/JS/AvisoEliminar.js"></script>
</body>

</html>