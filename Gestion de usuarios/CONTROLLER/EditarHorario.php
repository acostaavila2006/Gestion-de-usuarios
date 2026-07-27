<?php
if (!empty($_POST['Cambiar'])) {
    if (!empty($_POST['Tipo']) or !empty($_POST['Hinicio']) or !empty($_POST['Hfin'])) {
        $Tipo = $_POST['Tipo'];
        $Hinicio = $_POST['Hinicio'];
        $Hfin = $_POST['Hfin'];

        $sql = $Conexion->query("UPDATE horariospoliticas SET Hinicio='$Hinicio', Hfin='$Hfin' WHERE ID=$ID");

        switch ($_POST['Tipo']) {
            case '1':
                $sql = $Conexion->query("UPDATE horariospoliticas SET Tipo='Entrada', Hinicio='$Hinicio', Hfin='$Hfin' WHERE ID=$ID");
                break;
            case '2':
                $sql = $Conexion->query("UPDATE horariospoliticas SET Tipo='Salida', Hinicio='$Hinicio', Hfin='$Hfin' WHERE ID=$ID");
                break;
            case '3':
                $sql = $Conexion->query("UPDATE horariospoliticas SET Tipo='Pausa', Hinicio='$Hinicio', Hfin='$Hfin' WHERE ID=$ID");
                break;
            case '4':
                $sql = $Conexion->query("UPDATE horariospoliticas SET Tipo='Regreso', Hinicio='$Hinicio', Hfin='$Hfin' WHERE ID=$ID");
                break;
        }

        if ($sql == 1) {
            header("Location: ../HorariosPoliticas.php");
        } else {
            print "No se pudo editar el usuario";
        }
    } else {
        header("Location: EditarUsuario.php");
    }
}
