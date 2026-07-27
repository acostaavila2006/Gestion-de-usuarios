<?php
include('../MODEL/SQL/Conexion.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // seguridad básica
    $sql = $Conexion->prepare("DELETE FROM politicaspausas WHERE ID = ?");
    $sql->bind_param("i", $id);
    $sql->execute();

    // Redirigir de vuelta a la página original
    header("Location: ../VIEW/Administrador/HorariosPoliticas.php");
    exit();
} else {
    echo "ID no especificado.";
}
?>

