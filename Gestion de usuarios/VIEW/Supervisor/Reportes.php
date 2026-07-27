<?php
session_start();
if (empty($_SESSION['Nombre']) || empty($_SESSION['Pass'])) {
  header('Location: ../Login.php');
  exit();
} elseif ($_SESSION['Rol'] != 2) {
  switch ($_SESSION['Rol']) {
    case 1:
      header("Location: ../Administrador/GestionUsuarios.php");
      exit();
    case 3:
      header("Location: ../Funcionario/HistorialMarcas.php");
      exit();
    default:
      header('Location: ../Login.php');
      exit();
  }
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte Semanal | Geocorp</title>
  <link rel="stylesheet" href="../../CSS/Supervisor/Reportes.css">
</head>

<body>
  <?php include_once('../Menu/MenuSupervisor.html'); ?>

  <main>
    <section class="card">
      <h2>Reporte semanal de asistencia</h2>
      <h4>Resumen de horas trabajadas por funcionario</h4>
<?php
include('../../MODEL/SQL/Conexion.php');
include('../../CONTROLLER/ReporteSemanal.php')
?>
      <table>
        <thead>
          <tr>
            <th>Funcionario</th>
            <th>Semana</th>
            <th>Horas trabajadas</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['Nombre'] . ' ' . $row['Apellido']) ?></td>
              <td><?= htmlspecialchars($row['Semana']) ?></td>
              <td><?= htmlspecialchars($row['HorasTrabajadas'] ?: '0:00:00') ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

