<?php
$sql = "
SELECT 
    g.ID,
    g.Nombre,
    g.Apellido,
    MAX(m.Fecha) AS ultima_fecha,
    (
        SELECT m2.Tipo
        FROM marcas m2
        WHERE m2.id_usuario = g.ID
        ORDER BY m2.ID DESC
        LIMIT 1
    ) AS ultimo_tipo
FROM gestion_usuarios g
LEFT JOIN marcas m ON g.ID = m.id_usuario
WHERE g.Rol = 3
GROUP BY g.ID, g.Nombre, g.Apellido

";

$resultado = $Conexion->query($sql);
?>