<?php
class AsistenciaModel
{
    private $db;

    public function __construct($conexion)
    {
        $this->db = $conexion;
    }

    public function obtenerEstadisticas()
    {
        $sql = "SELECT 
                    u.Nombre AS usuario,
                    COUNT(a.id) AS total_asistencias
                FROM gestion_usuarios u
                LEFT JOIN asistencias a ON u.ID = a.id
                GROUP BY u.ID, u.Nombre
                ORDER BY total_asistencias DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
