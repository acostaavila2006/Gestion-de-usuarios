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
  <title>Validación</title>
  <link rel="stylesheet" href="../../CSS/Supervisor/Validaciones.css">
</head>

<body>
  <?php
  include_once('../Menu/MenuSupervisor.html');
  ?>

  <!-- Contenido -->
  <main>
    <!-- Listado diario/semanal -->
    <section id="Marcas" class="card">
      <?php
      include('../../MODEL/SQL/Conexion.php');
      include('../../CONTROLLER/validacionMarcas.php');
      ?>
      <h2>Marcas irregulares</h2>
      <h4>Aprobar/Rechazar marcas irregulares</h4>
      <table>
        <tr>
          <th>Nombre</th>
          <th>Tipo</th>
          <th>Fecha</th>
          <th></th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $fila['Nombre'] . " " . $fila['Apellido']; ?></td>
            <td><?php echo $fila['Tipo']; ?></td>
            <td><?php echo $fila['Fecha']; ?></td>
            <td style="text-align: center;">
              <?php if ($fila['Estado'] == 'Pendiente') { ?>
                <a href="../../CONTROLLER/validarMarca.php?id=<?= $fila['ID']; ?>&accion=validar">
                  <button style="width: 100%; background-color:green">Validar</button>
                </a>
                <a href="../../CONTROLLER/validarMarca.php?id=<?= $fila['ID']; ?>&accion=rechazar">
                  <button style="width: 100%; background-color:red">Rechazar</button>
                </a>
              <?php } else { ?>
                <span><?= $fila['Estado']; ?></span>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </section>
  </main>

</body>

</html>