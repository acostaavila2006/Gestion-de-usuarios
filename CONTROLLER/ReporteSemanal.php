<?php

$sql = "
SELECT
    u.Nombre,
    u.Apellido,
    WEEK(d.Fecha, 1) AS Semana,
    SEC_TO_TIME(SUM(d.SegundosTrabajados)) AS HorasTrabajadas
FROM (
    SELECT
        m.id_usuario,
        DATE(m.Fecha) AS Fecha,
        TIMESTAMPDIFF(SECOND,
            MIN(CASE WHEN m.Tipo = 'Entrada' THEN m.Fecha END),
            MAX(CASE WHEN m.Tipo = 'Salida' THEN m.Fecha END)
        ) AS SegundosTrabajados
    FROM marcas m
    WHERE m.Estado = 'Validado'
    GROUP BY m.id_usuario, DATE(m.Fecha)
) AS d
INNER JOIN gestion_usuarios u ON d.id_usuario = u.ID
GROUP BY u.ID, Semana
ORDER BY Semana DESC;
";

$result = $Conexion->query($sql);

// Si hay error, lo mostramos
if (!$result) {
    die("❌ Error en la consulta SQL: " . $Conexion->error);
}
?>