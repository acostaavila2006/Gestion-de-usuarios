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
    <title>Resumen semanal</title>
    <link rel="stylesheet" href="../../CSS/Funcionario/ResumenSemanal.css">
</head>

<body>
    <?php
    include_once('../Menu/MenuFuncionario.html');
    ?>
    <!-- Contenido -->
    <main>
        <!-- Total de horas trabajadas -->
        <section id="Horas" class="card">
            <h2>Resumen semanal de horas</h2>
            <h4>Total de horas trabajadas y horas en pausa</h4>

            <table>
                <tr>
                    <th>Semana</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Horas trabajadas</th>
                    <th>Horas pausa</th>
                </tr>
                <?php
                include('../../CONTROLLER/ResumenSemanal.php');
                ?>
            </table>
        </section>
    </main>

</body>

</html>