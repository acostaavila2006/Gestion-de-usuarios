<?php
include('../../MODEL/SQL/Conexion.php');
$idUsuario = $_SESSION['ID'] ?? null;
if (!$idUsuario) {
    echo "<tr><td colspan='3'>Usuario no identificado</td></tr>";
    exit;
}

$vista = $_GET['vista'] ?? 'diaria';

if ($vista === 'diaria') {
    // 🔹 Modo diario
    $stmt = $Conexion->prepare("
              SELECT DATE(Fecha) AS dia, Tipo, Fecha
              FROM marcas
              WHERE id_usuario = ?
              ORDER BY Fecha ASC
          ");
} else {
    // 🔹 Modo semanal
    $stmt = $Conexion->prepare("
              SELECT YEAR(Fecha) AS anio, WEEK(Fecha, 1) AS semana, Tipo, Fecha
              FROM marcas
              WHERE id_usuario = ?
              ORDER BY Fecha ASC
          ");
}

$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($vista === 'diaria') {
    $marcasPorDia = [];
    while ($row = $resultado->fetch_assoc()) {
        $marcasPorDia[$row['dia']][] = $row;
    }

    if (empty($marcasPorDia)) {
        echo "<tr><td colspan='3'>No hay marcas registradas</td></tr>";
    }

    foreach ($marcasPorDia as $dia => $marcas) {
        $horaEntrada = null;
        $horaSalida = null;
        $inicioPausa = null;
        $totalPausa = 0;

        foreach ($marcas as $m) {
            $tipo = $m['Tipo'];
            $ts = strtotime($m['Fecha']);

            if ($tipo === 'Entrada' && $horaEntrada === null) $horaEntrada = $ts;
            elseif ($tipo === 'Salida') $horaSalida = $ts;
            elseif ($tipo === 'Pausa') $inicioPausa = $ts;
            elseif ($tipo === 'Regreso' && $inicioPausa) {
                $totalPausa += $ts - $inicioPausa;
                $inicioPausa = null;
            }
        }

        if ($horaEntrada && $horaSalida) {
            $totalTrabajo = ($horaSalida - $horaEntrada) - $totalPausa;
            $horas = floor($totalTrabajo / 3600);
            $minutos = floor(($totalTrabajo % 3600) / 60);
            $pausaHoras = floor($totalPausa / 3600);
            $pausaMin = floor(($totalPausa % 3600) / 60);

            echo "<tr>
                          <td>" . date('d/m/Y', strtotime($dia)) . "</td>
                          <td>{$horas}h {$minutos}m</td>
                          <td>{$pausaHoras}h {$pausaMin}m</td>
                        </tr>";
        } else {
            echo "<tr><td>" . date('d/m/Y', strtotime($dia)) . "</td><td colspan='2'>Datos incompletos</td></tr>";
        }
    }
} else {
    // 🔹 Modo semanal
    $marcasPorSemana = [];
    while ($row = $resultado->fetch_assoc()) {
        $clave = $row['anio'] . '-' . $row['semana'];
        $marcasPorSemana[$clave][] = $row;
    }

    if (empty($marcasPorSemana)) {
        echo "<tr><td colspan='3'>No hay marcas registradas</td></tr>";
    }

    foreach ($marcasPorSemana as $clave => $marcas) {
        $totalTrabajo = 0;
        $totalPausa = 0;
        $horaEntrada = null;
        $horaSalida = null;
        $inicioPausa = null;

        foreach ($marcas as $m) {
            $tipo = $m['Tipo'];
            $ts = strtotime($m['Fecha']);

            if ($tipo === 'Entrada' && $horaEntrada === null) $horaEntrada = $ts;
            elseif ($tipo === 'Salida') $horaSalida = $ts;
            elseif ($tipo === 'Pausa') $inicioPausa = $ts;
            elseif ($tipo === 'Regreso' && $inicioPausa) {
                $totalPausa += $ts - $inicioPausa;
                $inicioPausa = null;
            }

            if ($horaEntrada && $horaSalida) {
                $totalTrabajo += ($horaSalida - $horaEntrada);
                $horaEntrada = null;
                $horaSalida = null;
            }
        }

        $horas = floor(($totalTrabajo - $totalPausa) / 3600);
        $minutos = floor((($totalTrabajo - $totalPausa) % 3600) / 60);
        $pausaHoras = floor($totalPausa / 3600);
        $pausaMin = floor(($totalPausa % 3600) / 60);

        echo "<tr>
                      <td>Semana $clave</td>
                      <td>{$horas}h {$minutos}m</td>
                      <td>{$pausaHoras}h {$pausaMin}m</td>
                    </tr>";
    }
}
