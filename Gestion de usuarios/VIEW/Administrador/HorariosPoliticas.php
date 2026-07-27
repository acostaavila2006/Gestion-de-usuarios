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
  <title>Politicas de horarios</title>
  <link rel="stylesheet" href="../../CSS/Administrador/HorariosPolitica.css">
</head>

<body>
  <?php
  include_once('../Menu/MenuAdministrador.html');
  ?>

  <!-- Contenido -->
  <main>
    <!-- Modificacion de horarios estandar -->
    <section id="Modificacion" class="card">
      <h2>Modificacion</h2>
      <h4>Modificacion de horarios estandar</h4>
      <a href="form/AgregarHorario.php"><button>Agregar horario +</button></a>
      <table>
        <tr>
          <th>Nombre de horario</th>
          <th>H. Entrada</th>
          <th>H. Salida</th>
          <th>Editar</th>
          <th>Eliminar</th>
        </tr>
        <?php
        include('../../MODEL/SQL/Conexion.php');
        include('../../CONTROLLER/EliminarHorario.php');
        $sql = $Conexion->query("SELECT*FROM horariospoliticas");
        while ($mostrar = $sql->fetch_object()) {
        ?>
          <tr>
            <td><?php echo $mostrar->Tipo ?></td>
            <td><?php echo $mostrar->Hinicio ?></td>
            <td><?php echo $mostrar->Hfin ?></td>
            <td style="text-align: center;"><a href="form/EditarHorario.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%;">Editar</button></a></td>
            <td style="text-align: center;"><a onclick="return eliminar();" href="HorariosPoliticas.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%; background-color:red">Eliminar</button></a></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </section>
  </main>

  <script src="../../CONTROLLER/JS/AvisoEliminar.js"></script>
</body>

</html>