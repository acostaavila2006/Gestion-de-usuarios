<?php
require_once 'MODEL/SQL/DB.php';
require_once 'CONTROLLER/InsertController.php';
require_once 'CONTROLLER/AsistenciaController.php';

$conexion = new Conexion();
$controller = new InsertController($conexion);
$ControllerAsis = new AsistenciaController($conexion);
$ControllerPausa = new InsertController($conexion);


if (isset($_GET['controller']) && isset($_GET['action'])) {
    if ($_GET['controller'] == 'Usuario' && $_GET['action'] == 'agregar') {
        $controller->agregar();
        $controller->agregarHorario();
    } elseif ($_GET['controller'] == 'Asistencia' && $_GET['action'] == 'estadisticas') {
        $ControllerAsis->estadisticas();
    }
    elseif ($_GET['controller'] == 'Pausa' && $_GET['action'] == 'agregarPausa') {
        $ControllerPausa->AgregarPausa();
    }
} else {
    header("Location: VIEW/Login.php");
    exit();
}
?>
