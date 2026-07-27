<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/formulario.css">
    <link rel="stylesheet" href="../../../CSS/Administrador/form/AgregarUsuario.css">
    <title>Agregar usuario</title>
</head>

<body>
    <div class="CampoForm">
        <form method="post" action="../../../INDEX.php?controller=Usuario&action=agregar">
            <h1>Agregar usuario</h1>

            <div class="campos" >
                <input type="text" placeholder="Nombre" name="Nombre" required><br>
                <input type="text" placeholder="Apellido" name="Apellido" required><br>
                <input type="email" placeholder="Email" name="Email" required><br>
                <input type="password" placeholder="Contraseña" name="Pass" required><br>
            </div>
            <div class="campos">
                <label>Rol:</label>
                <select name="TipoRol" required>
                    <option selected disabled>Seleccionar</option>
                    <option value="1">Administrador</option>
                    <option value="2">Supervisor</option>
                    <option value="3">Funcionario</option>
                </select><br>
            </div>
            <input class="Ingresar" type="submit" value="Agregar" name="Agregar">
            <button type="button" onclick="window.location.href='../GestionUsuarios.php'">Volver</button>
        </form>
    </div>
</body>

</html>