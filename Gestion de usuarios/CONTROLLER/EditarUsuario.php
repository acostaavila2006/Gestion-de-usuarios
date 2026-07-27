<?php
if (!empty($_POST['Cambiar'])) {
    if (!empty($_POST['Nombre']) or !empty($_POST['Apellido']) or !empty($_POST['Pass']) or !empty($_POST['Email'])) {
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Pass = $_POST['Pass'];
        $Email = $_POST['Email'];
        $Rol = $_POST['Rol'];

        $sql = $Conexion->query("UPDATE gestion_usuarios SET Nombre='$Nombre', Apellido='$Apellido', Pass='$Pass', Email='$Email' WHERE ID=$ID");

        switch ($_POST['Rol']) {
            case '1':
                $sql = $Conexion->query("UPDATE gestion_usuarios SET Nombre='$Nombre', Apellido='$Apellido', Pass='$Pass', Email='$Email', Rol=1 WHERE ID=$ID");
                break;
            case '2':
                $sql = $Conexion->query("UPDATE gestion_usuarios SET Nombre='$Nombre', Apellido='$Apellido', Pass='$Pass', Email='$Email', Rol=2 WHERE ID=$ID");
                break;
            case '3':
                $sql = $Conexion->query("UPDATE gestion_usuarios SET Nombre='$Nombre', Apellido='$Apellido', Pass='$Pass', Email='$Email', Rol=3 WHERE ID=$ID");
                break;
        }

        if ($sql == 1) {
            header("Location: ../GestionUsuarios.php");
        } else {
            print "No se pudo editar el usuario";
        }
    } else {
        header("Location: EditarUsuario.php");
    }
}
?>