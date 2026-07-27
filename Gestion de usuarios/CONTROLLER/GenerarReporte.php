<?php
include('../MODEL/SQL/Conexion.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "
      SELECT
        u.Nombre,
        m.Tipo,
        m.Fecha,
        m.Comentario,
        m.Estado
      FROM marcas m
      INNER JOIN gestion_usuarios u ON m.id_usuario = u.ID
      WHERE u.ID = $id
      ORDER BY m.Fecha ASC
    ";

    $resultado = $Conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="ReporteUsuario_'.$id.'.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Nombre', 'Tipo', 'Fecha', 'Comentario', 'Estado']);

        while ($fila = $resultado->fetch_assoc()) {
            fputcsv($output, $fila);
        }

        fclose($output);
        exit;
    } else {
        echo "No se encontraron datos para este usuario.";
    }
} else {
    echo "ID de usuario no especificado.";
}
?>
