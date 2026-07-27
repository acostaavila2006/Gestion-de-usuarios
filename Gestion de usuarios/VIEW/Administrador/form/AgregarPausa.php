<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/formulario.css">
    <link rel="stylesheet" href="../../../CSS/Administrador/form/AgregarHorario.css">
    <title>Agregar pausa</title>
</head>

<body>
    <div class="CampoForm">
        <form method="post" action="../../../INDEX.php?controller=Pausa&action=agregarPausa">
            <h1>Agregar pausa</h1>

            <div class="campos">
                <input type="text" placeholder="Nombre de pausa" name="NombrePausa"><br>
                <label>Horario de inicio:</label>
                <input type="time" name="Hinicio"><br>
                <label>Fin de la pausa:</label>
                <input type="time" name="Hfin"><br>
            </div>
            <input class="Ingresar" type="submit" value="Ingresar" name="Ingresar">
            <button type="button" onclick="window.location.href='../HorariosPoliticas.php'">Volver</button>
        </form>
    </div>
</body>

</html>