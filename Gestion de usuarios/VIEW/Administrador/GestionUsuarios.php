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
  <title>Gestion de usuarios</title>
  <link rel="stylesheet" href="../../CSS/Administrador/GestionUsuari.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
  <?php
  include_once('../Menu/MenuAdministrador.html');
  ?>

  <!-- Contenido -->
  <main>
    <!-- Funcionarios -->
    <section id="Funcionarios" class="card">
      <h2>Funcionarios</h2>
      <h4>Gestionar funcionarios</h4>
      <a href="form/AgregarUsuario.php"><button>Agregar +</button></a>
      <table id="Funcionario">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>F. creacion</th>
            <th>F. Modificacion</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../../MODEL/SQL/Conexion.php');
          include('../../CONTROLLER/EliminarUser.php');
          $sql = $Conexion->query("SELECT*FROM gestion_usuarios WHERE Rol = 3");
          while ($mostrar = $sql->fetch_object()) {
          ?>
            <tr>
              <td><?php echo $mostrar->Nombre ?></td>
              <td><?php echo $mostrar->Apellido ?></td>
              <td><?php echo $mostrar->Email ?></td>
              <td><?php echo $mostrar->Pass ?></td>
              <td><?php echo $mostrar->Fcreacion ?></td>
              <td><?php echo $mostrar->Fmod ?></td>
              <td style="text-align: center;"><a href="form/EditarUsuario.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%;">Editar</button></a></td>
              <td style="text-align: center;"><a onclick="return eliminar();" href="GestionUsuarios.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%; background-color:red">Eliminar</button></a></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Supervisores -->
    <section id="Supervisores" class="card">
      <h2>Supervisores</h2>
      <h4>Gestionar supervisores</h4>
      <a href="form/AgregarUsuario.php"><button>Agregar +</button></a>
      <table id="Supervisor" class="display">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>F. creacion</th>
            <th>F. Modificacion</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../../MODEL/SQL/Conexion.php');
          $sql = $Conexion->query("SELECT*FROM gestion_usuarios WHERE Rol = 2");
          while ($mostrar = $sql->fetch_object()) {
          ?>
            <tr>
              <td><?php echo $mostrar->Nombre ?></td>
              <td><?php echo $mostrar->Apellido ?></td>
              <td><?php echo $mostrar->Email ?></td>
              <td><?php echo $mostrar->Pass ?></td>
              <td><?php echo $mostrar->Fcreacion ?></td>
              <td><?php echo $mostrar->Fmod ?></td>
              <td style="text-align: center;"><a href="form/EditarUsuario.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%;">Editar</button></a></td>
              <td style="text-align: center;"><a onclick="return eliminar();" href="GestionUsuarios.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%; background-color:red">Eliminar</button></a></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </section>

    <!-- Admnistrador -->
    <section id="Administradores" class="card">
      <h2>Administradores</h2>
      <h4>Gestionar Administradores</h4>
      <a href="form/AgregarUsuario.php"><button>Agregar +</button></a>
      <table id="Administrador">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>F. creación</th>
            <th>F. modificación</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../../MODEL/SQL/Conexion.php');
          $sql = $Conexion->query("SELECT * FROM gestion_usuarios WHERE Rol = 1");
          while ($mostrar = $sql->fetch_object()) {
          ?>
            <tr>
              <td><?= htmlspecialchars($mostrar->Nombre) ?></td>
              <td><?= htmlspecialchars($mostrar->Apellido) ?></td>
              <td><?= htmlspecialchars($mostrar->Email) ?></td>
              <td><?= htmlspecialchars($mostrar->Pass) ?></td>
              <td><?= htmlspecialchars($mostrar->Fcreacion ?? '') ?></td>
              <td><?= htmlspecialchars($mostrar->Fmod ?? '') ?></td>
              <td style="text-align: center;"><a href="form/EditarUsuario.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%;">Editar</button></a></td>
              <td style="text-align: center;"><a onclick="return eliminar();" href="GestionUsuarios.php?id=<?= $mostrar->ID; ?>"><button style="width: 100%; background-color:red">Eliminar</button></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </main>

  <!-- SCRIPTS: jQuery + DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script src="../../CONTROLLER/JS/Filtros.js"></script>
  <script src="../../CONTROLLER/JS/AvisoEliminar.js"></script>
</body>

</html>