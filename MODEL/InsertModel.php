<?php
class InsertModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion->pdo;
    }

    public function agregarUsuario($nombre, $apellido, $email, $pass, $rol) {
        $sql = $this->db->prepare("INSERT INTO gestion_usuarios (Nombre, Apellido, Pass, Email, Rol)
                                   VALUES (?, ?, ?, ?, ?)");
        return $sql->execute([$nombre, $apellido, $pass, $email, $rol]);
    }

    public function agregarHorario($Tipo, $Hinicio, $Hfin) {
        $sql = $this->db->prepare("INSERT INTO horariospoliticas (Tipo, Hinicio, Hfin)
                                   VALUES (?, ?, ?)");
        return $sql->execute([$Tipo, $Hinicio, $Hfin]);
    }

    public function agregarPausa($NombrePausa, $Hinicio, $Hfin) {
        $sql = $this->db->prepare("INSERT INTO politicaspausas (Nombrepausa, H_inicio, H_fin)
                                   VALUES (?, ?, ?)");
        return $sql->execute([$NombrePausa, $Hinicio, $Hfin]);
    }
}
?>
