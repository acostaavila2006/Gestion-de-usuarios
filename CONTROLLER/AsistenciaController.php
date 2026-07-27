<?php
require_once 'MODEL/AsistenciaModel.php';

class AsistenciaController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new AsistenciaModel($conexion);
    }

    public function estadisticas() {
        $datos = $this->modelo->obtenerEstadisticas();
        include 'VIEW/Administrador/ReportesGlobales.php'; // $datos estará disponible aquí
    }
}
?>
