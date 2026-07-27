<?php
include('../MODEL/SQL/Conexion.php');

$id = $_GET['id'];
$accion = $_GET['accion'];

if ($accion == 'validar') {
    $estado = 'Validado';
} else {
    $estado = 'Rechazado';
}

$Conexion->query("UPDATE marcas SET Estado = '$estado' WHERE ID = $id");

header('Location: ../VIEW/Supervisor/Validacion.php');
exit();
?>
