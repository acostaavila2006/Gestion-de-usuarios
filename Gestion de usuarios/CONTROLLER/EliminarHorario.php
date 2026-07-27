<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $Conexion->query("DELETE FROM horariospoliticas WHERE ID = '$id'");
}
?>
