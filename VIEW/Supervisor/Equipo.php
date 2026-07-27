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
  <title>Equipo</title>
  <link rel="stylesheet" href="../../CSS/Supervisor/Equipos.css">
</head>

<body>
  <?php
  include_once('../Menu/MenuSupervisor.html');
  ?>

  <!-- Contenido -->
  <main>
    <!-- Ver marcas por funcionario -->
    <section id="Ver" class="card">
      <?php
      include('../../MODEL/SQL/Conexion.php');
      include('../../CONTROLLER/VerMarcasFuncionario.php');
      ?>
      <h2>Marcas</h2>
      <h4>Ver marcas por funcionario</h4>
      <table>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Ultima marca</th>
          <th>Última fecha</th>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_object()) {
            echo "
          <tr>
            <td>{$fila->Nombre}</td>
            <td>{$fila->Apellido}</td>
            <td>{$fila->ultimo_tipo}</td>
            <td>{$fila->ultima_fecha}</td>
          </tr>
        ";
          }
        } else {
          echo "<tr><td colspan='3' style='text-align:center;'>No hay marcas registradas.</td></tr>";
        }
        ?>
      </table>
    </section>
  </main>

</body>

</html>