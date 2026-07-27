<?php
$idUsuario = $_SESSION['ID'] ?? null;

if (!$idUsuario) {
    echo "<tr><td colspan='3'>Usuario no identificado (ID de sesión ausente)</td></tr>";
    exit;
}

// Obtener marcas del usuario
$stmt = $Conexion->prepare("SELECT Fecha, Tipo FROM marcas WHERE id_usuario = ? ORDER BY Fecha ASC");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$resultado = $stmt->get_result();

$marcasPorDia = [];
while ($row = $resultado->fetch_assoc()) {
    $dia = date('Y-m-d', strtotime($row['Fecha']));
    $marcasPorDia[$dia][] = $row;
}
$stmt->close();

// Si no hay marcas, mostrar mensaje
if (empty($marcasPorDia)) {
    echo "<tr><td colspan='3'>No hay marcas registradas para este usuario.</td></tr>";
    exit;
}

// Calcular por cada día
foreach ($marcasPorDia as $dia => $marcas) {
    $horaEntrada = null;
    $horaSalida = null;
    $inicioPausa = null;
    $totalPausa = 0;

    // Recorremos en orden cronológico (ya ordenadas por Fecha ASC)
    foreach ($marcas as $m) {
        $tipo = $m['Tipo'];
        $ts = strtotime($m['Fecha']);

        if ($tipo === 'Entrada' && $horaEntrada === null) {
            // guardo la primera entrada del día
            $horaEntrada = $ts;
        } elseif ($tipo === 'Salida') {
            // actualizo la salida (la última salida será la válida)
            $horaSalida = $ts;
        } elseif ($tipo === 'Pausa') {
            $inicioPausa = $ts;
        } elseif ($tipo === 'Regreso' && $inicioPausa) {
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
        echo "<tr>
                <td>" . date('d/m/Y', strtotime($dia)) . "</td>
                <td colspan='2'>Datos incompletos</td>
             </tr>";
    }
}
