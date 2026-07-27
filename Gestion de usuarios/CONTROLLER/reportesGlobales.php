<?php
        $sql = "
  SELECT 
      u.ID AS id_usuario,
      u.Nombre,
      SEC_TO_TIME(SUM(TIMESTAMPDIFF(SECOND, m1.Fecha, m2.Fecha))) AS horas_trabajadas,
      '40:00:00' AS horas_esperadas,
      SUM(CASE WHEN TIME(m1.Fecha) > '09:00:00' THEN 1 ELSE 0 END) AS llegadas_tarde,
      (
  SELECT COUNT(*) 
  FROM marcas m 
  WHERE m.id_usuario = u.ID 
    AND m.Estado IN ('Pendiente', 'Validado', 'Rechazado')
) AS marcas_irregulares
  FROM gestion_usuarios u
  LEFT JOIN marcas m1 ON u.ID = m1.id_usuario AND m1.Tipo = 'Entrada'
  LEFT JOIN marcas m2 ON u.ID = m2.id_usuario AND m2.Tipo = 'Salida' AND DATE(m1.Fecha) = DATE(m2.Fecha)
  WHERE u.Rol = 3
  GROUP BY u.ID
  ORDER BY u.Nombre ASC
";


        $resultado = $Conexion->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['Nombre']}</td>
                    <td>{$fila['horas_trabajadas']}</td>
                    <td>{$fila['horas_esperadas']}</td>
                    <td>{$fila['llegadas_tarde']}</td>
                    <td>{$fila['marcas_irregulares']}</td>
                    <td style='text-align:center'>
                      <a href='../../CONTROLLER/GenerarReporte.php?id={$fila['id_usuario']}' target='_blank'>
                        <button>Exportar</button>
                      </a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No se encontraron registros</td></tr>";
        }
        ?>