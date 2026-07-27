<?php

$sql = "
SELECT
    m.ID,
    g.Nombre,
    g.Apellido,
    m.Tipo,
    m.Fecha,
    m.Estado,
    CASE
        WHEN m.Tipo = p.Tipo
             AND (m.Fecha BETWEEN p.Hinicio AND p.Hfin)
        THEN 'Correcta'
        ELSE 'Irregular'
    END AS TipoM
FROM marcas m
JOIN gestion_usuarios g ON g.ID = m.id_usuario
JOIN horariospoliticas p ON m.Tipo = p.Tipo
WHERE NOT (m.Fecha BETWEEN p.Hinicio AND p.Hfin);
";

$resultado = $Conexion->query($sql);
