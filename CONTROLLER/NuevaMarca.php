<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $Comentario = $_POST['Com'] ?? '';

  if (isset($_POST['Entrada'])) {
    $tipo = 'Entrada';
  } elseif (isset($_POST['Salida'])) {
    $tipo = 'Salida';
  } elseif (isset($_POST['Pausa'])) {
    $tipo = 'Pausa';
  } elseif (isset($_POST['Regreso'])) {
    $tipo = 'Regreso';
  } else {
    $tipo = null;
  }

  if ($tipo !== null) {
    $idUsuario = $_SESSION['ID'] ?? null;

    if (!$idUsuario) {
      echo "No se encontró ID de usuario en la sesión.";
      exit;
    }

    // Prepared statement para insertar
    $stmt = $Conexion->prepare("INSERT INTO marcas (id_usuario, Tipo, Comentario, Estado) VALUES (?, ?, ?, 'Pendiente')");
    $stmt->bind_param("iss", $idUsuario, $tipo, $Comentario);
    $ok = $stmt->execute();
    $stmt->close();

    if ($ok) {
      header("Location: RegistrarMarcas.php?success=1");
      exit();
    } else {
      header("Location: RegistrarMarcas.php?error=1");
      exit();
    }
  }
}
