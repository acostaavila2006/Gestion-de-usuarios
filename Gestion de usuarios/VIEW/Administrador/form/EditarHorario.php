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
    <title>Editar horario</title>
</head>

<body>
    <div class="CampoForm">

        <form method="post">
            <?php
            include('../../../MODEL/SQL/Conexion.php');
            $sql = $Conexion->query("SELECT * FROM horariospoliticas WHERE id='$ID'");
            include('../../../CONTROLLER/EditarHorario.php');


            while ($mostrar = $sql->fetch_object()) { ?>
                <h1>Editar horario</h1>

                <div class="campos">
                    <label>Nombre de horario:</label>
                    <select name="Tipo" required>
                        <option selected disabled><?= $mostrar->Tipo ?></option>
                        <option value="1">Entrada</option>
                        <option value="2">Salida</option>
                        <option value="3">Pausa</option>
                        <option value="4">Regreso</option>
                    </select><br>
                    <label>Horario de entrada:</label>
                    <input type="time" name="Hinicio" value="<?= $mostrar->Hinicio ?>" required><br>
                    <label>Horario de salida:</label>
                    <input type="time" name="Hfin" value="<?= $mostrar->Hfin ?>" required><br>
                </div>
                <input class="Ingresar" type="submit" value="Cambiar" name="Cambiar">
                <button type="button" onclick="window.location.href='../HorariosPoliticas.php'">Volver</button>
            <?php
            }
            ?>
        </form>

    </div>
    <script src="../../../CONTROLLER/JS/AvisoEliminar.js"></script>
</body>

</html>