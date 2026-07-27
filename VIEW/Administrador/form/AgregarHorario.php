<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/formulario.css">
    <link rel="stylesheet" href="../../../CSS/Administrador/form/AgregarHorario.css">
    <title>Agregar horario</title>
</head>

<body>
    <div class="CampoForm">
        <form method="post" action="../../../INDEX.php?controller=Usuario&action=agregar">
            <h1>Agregar horario</h1>

            <div class="campos">
                <label>Nombre de horario:</label>
                <select name="Tipo" required>
                    <option selected disabled>Seleccionar</option>
                    <option value="Entrada">Entrada</option>
                    <option value="Salida">Salida</option>
                    <option value="Pausa">Pausa</option>
                    <option value="Regreso">Regreso</option>
                </select><br>
                <label>Horario de entrada:</label>
                <input type="time" placeholder="Hora de entrada" name="Hinicio" required><br>
                <label>Horario de salida:</label>
                <input type="time" placeholder="Hora de entrada" name="Hfin" required><br>
            </div>
            <input class="Ingresar" type="submit" value="Agregar" name="Agregar">
            <button type="button" onclick="window.location.href='../HorariosPoliticas.php'">Volver</button>
        </form>
    </div>
</body>

</html>