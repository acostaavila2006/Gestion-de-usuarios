<?php
if (!empty($_POST['Ingresar'])) {
    if (!empty($_POST['NombrePausa']) and !empty($_POST['Pass']) and !empty($_POST['Rol']) and !empty($_POST['Fecha'])) {
        $Nombre = $_POST['NombreUser'];
        $Pass = $_POST['Pass'];
        $Rol = $_POST['Rol'];
        $Fecha = $_POST['Fecha'];

        $sql = $Conexion->query("INSERT INTO usuarios(Nombre, Pass, Rol, Fecha) VALUES ('$Nombre', '$Pass', $Rol, '$Fecha')");

        if ($sql == 1) {
            header("Location: Admin_usuarios.php");
        }else {
            print "No se pudo registrar al usuario";
        }
    }else {
        print "Uno de los campos está vacío";
    }
}
?>