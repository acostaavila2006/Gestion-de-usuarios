<?php
session_start();


if (!empty($_POST["Ingresar"])) {
    if (!empty($_POST["Usuario"]) && !empty($_POST["Pass"])) {
        $Usuario = $_POST["Usuario"];
        $Pass = $_POST["Pass"];

        $Consulta = "SELECT ID, Nombre, Pass, Rol FROM gestion_usuarios WHERE Nombre = '$Usuario' AND Pass = '$Pass'";
        $Resultado = $Conexion->query($Consulta);

        if ($Resultado && $Resultado->num_rows > 0) {
            $datos = $Resultado->fetch_assoc();

            $_SESSION["ID"] = $datos["ID"];
            $_SESSION["Nombre"] = $datos["Nombre"];
            $_SESSION["Pass"] = $datos["Pass"];
            $_SESSION["Rol"] = $datos["Rol"];


            if ($datos["Rol"] == 1) {
                header("Location: Administrador/GestionUsuarios.php");
            } elseif ($datos["Rol"] == 2) {
                header("Location: Funcionario/HistorialMarcas.php");
            } elseif ($datos["Rol"] == 3) {
                header("Location: Supervisor/Equipo.php");
            }
            exit;
        } else {
            echo "<div class='alert alert-danger' id='mensaje'>El usuario tiene un rol desconocido</div>";
        }
    } else {
        echo "<div class='alert alert-danger' id='mensaje'>Uno de los campos esta vacio</div>";
    }
}

?>

<script src="../JS/OcultarMensaje.js"></script>