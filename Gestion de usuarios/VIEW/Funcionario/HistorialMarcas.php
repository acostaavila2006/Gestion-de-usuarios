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
        case 2:
            header("Location: ../Supervisor/Equipo.php");
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
    <title>Historial de marcas</title>
    <link rel="stylesheet" href="../../CSS/Funcionario/HistorialMarca.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    <?php include_once('../Menu/MenuFuncionario.html'); ?>

    <main>
        <!-- Indicadores -->
        <section id="Indicadores" class="card">
            <h2>Indicadores</h2>
            <h4>Horas trabajadas y pausas</h4>

            <table id="Historial" class="display">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Horas trabajadas</th>
                        <th>Pausas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../MODEL/SQL/Conexion.php');
                    include('../../CONTROLLER/IndicadorHoras.php');
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Listado diario/semanal -->
        <section id="Listado" class="card">
            <h2>Listado</h2>
            <h4>Listado diario/semanal</h4>

            <table id="ListadoTabla" class="display">
                <thead>
                    <tr>
                        <th>Fecha / Semana</th>
                        <th>Horas trabajadas</th>
                        <th>Pausas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../CONTROLLER/HistorialMarcas.php');
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