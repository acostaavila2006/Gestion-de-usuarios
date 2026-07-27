<?php
session_start();

if (empty($_SESSION['Nombre']) || empty($_SESSION['Pass'])) {
  header('Location: ../Login.php');
  exit();
} elseif ($_SESSION['Rol'] != 3) {
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
  <title>Registrar marcas</title>
  <link rel="stylesheet" href="../../CSS/Funcionario/RegistrarMarcas.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <style>
  /* Estilo general de la barra de navegación */
  .dataTables_filter {
    margin-bottom: 1rem;
    text-align: right;
  }

  /* Estilo del input */
   #RegistroMarcas_filter input {
    border: 2px solid #007bff;
    border-radius: 4px;
    padding: 6px 10px;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
  }
</style>
</head>

<body>
  <?php
  include_once('../Menu/MenuFuncionario.html');
  ?>

  <!-- Contenido -->
  <main>
    <!-- Gestion de usuarios -->
    <section id="RegistrarMarcas" class="card">
      <h2>Registrar marcas</h2>

      <form method="post">
        <?php
        include('../../MODEL/SQL/Conexion.php');
        include('../../CONTROLLER/NuevaMarca.php');
        ?>
        <input type="submit" class="button" value="Entrada" name="Entrada">
        <input type="submit" class="button" value="Salida" name="Salida">
        <input type="submit" class="button" value="Pausa" name="Pausa">
        <input type="submit" class="button" value="Regreso" name="Regreso"><br><br>
        <textarea rows="4" placeholder="Comentario(opcional)" name="Com"></textarea>
      </form>
      <table id="RegistroMarcas">
        <thead>
          <tr>
          <th>Tipo</th>
          <th>Fecha</th>
          <th>Comentario</th>
        </tr>
        </thead>
        <tbody>
          <?php
        include('../../MODEL/SQL/Conexion.php');
        $user = $_SESSION['ID'];
        $sql = $Conexion->query("SELECT*FROM marcas WHERE id_usuario='$user'");
        while ($mostrar = $sql->fetch_object()) {
        ?>
          <tr>
            <td><?php echo $mostrar->Tipo ?></td>
            <td><?php echo $mostrar->Fecha ?></td>
            <td><?php echo $mostrar->Comentario ?></td>
          </tr>
        <?php
        }
        ?>
        </tbody>
        
      </table>
    </section>
  </main>

  <!-- SCRIPTS: jQuery + DataTables -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script src="../../CONTROLLER/JS/Filtros.js"></script>
</body>

</html>