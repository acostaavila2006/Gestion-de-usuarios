<?php
session_start();
if (empty($_SESSION['Nombre']) || empty($_SESSION['Pass'])) {
  header('Location: ../Login.php');
  exit();
} elseif ($_SESSION['Rol'] != 1) {
  switch ($_SESSION['Rol']) {
    case 2:
      header("Location: ../Supervisor/Equipo.php");
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
  <title>Reportes globales</title>
  <link rel="stylesheet" href="../../CSS/Administrador/ReportesGlobales.css">
</head>

<body>
  <?php include_once('../Menu/MenuAdministrador.html'); ?>

  <main>
    <section class="card">
      <h2>Reportes</h2>
      <h4>Resumen de marcas y horas trabajadas</h4>

      <table>
        <tr>
          <th>Funcionario</th>
          <th>Horas trabajadas</th>
          <th>Horas esperadas</th>
          <th>Llegadas tarde</th>
          <th>Marcas irregulares</th>
          <th>Exportar</th>
        </tr>

        <?php
        include('../../MODEL/SQL/Conexion.php');
        include('../../CONTROLLER/reportesGlobales.php')
        ?>
      </table>
    </section>
  </main>
</body>

</html>