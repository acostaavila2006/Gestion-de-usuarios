<?php
include('../../MODEL/SQL/Conexion.php');

// ID del usuario logueado
$idUsuario = $_SESSION['ID'];

// Consultar todas las marcas del usuario ordenadas por fecha
$consulta = $Conexion->prepare("SELECT Tipo, Fecha FROM marcas WHERE ID_Usuario = ? ORDER BY Fecha ASC");
$consulta->bind_param("i", $idUsuario);
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado->num_rows === 0) {
    echo "<tr><td colspan='5'>No hay marcas registradas para este usuario.</td></tr>";
} else {
    $marcasPorSemana = [];

    // Agrupar por semana
    while ($fila = $resultado->fetch_assoc()) {
        $semana = date("o-W", strtotime($fila['Fecha'])); // Ejemplo: 2025-43
        $marcasPorSemana[$semana][] = $fila;
    }

    // Recorrer semanas
    foreach ($marcasPorSemana as $semana => $marcas) {
        $horaEntrada = null;
        $inicioPausa = null;
        $totalTrabajo = 0;
        $totalPausa = 0;

        $fechas = array_column($marcas, 'Fecha');
        $inicioSemana = min($fechas);
        $finSemana = max($fechas);

        foreach ($marcas as $m) {
            $tipo = $m['Tipo'];
            $ts = strtotime($m['Fecha']);

            if ($tipo === 'Entrada' && !$horaEntrada) {
                $horaEntrada = $ts;
            } elseif ($tipo === 'Salida' && $horaEntrada) {
                $totalTrabajo += $ts - $horaEntrada;
                $horaEntrada = null;
            } elseif ($tipo === 'Pausa') {
                $inicioPausa = $ts;
            } elseif ($tipo === 'Regreso' && $inicioPausa) {
                $totalPausa += $ts - $inicioPausa;
                $inicioPausa = null;
            }
        }

        // Conversión de segundos a horas:minutos
        $hTrab = floor($totalTrabajo / 3600);
        $mTrab = floor(($totalTrabajo % 3600) / 60);
        $hPausa = floor($totalPausa / 3600);
        $mPausa = floor(($totalPausa % 3600) / 60);

        echo "<tr>
                        <td>$semana</td>
                        <td>" . date('d/m/Y', strtotime($inicioSemana)) . "</td>
                        <td>" . date('d/m/Y', strtotime($finSemana)) . "</td>
                        <td>{$hTrab}h {$mTrab}m</td>
                        <td>{$hPausa}h {$mPausa}m</td>
                      </tr>";
    }
}
