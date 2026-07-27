<?php
class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $clave = "";
    private $base = "proyecto";
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->base};charset=utf8", $this->usuario, $this->clave);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
