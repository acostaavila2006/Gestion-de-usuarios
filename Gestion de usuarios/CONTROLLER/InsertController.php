<?php
require_once './MODEL/InsertModel.php';

class InsertController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new InsertModel($conexion);
    }

    public function agregar() {
        if (!empty($_POST['Agregar'])) {
            if (!empty($_POST['Nombre']) && !empty($_POST['Apellido']) && !empty($_POST['Email']) &&
                !empty($_POST['Pass']) && !empty($_POST['TipoRol'])) {

                $nombre = $_POST['Nombre'];
                $apellido = $_POST['Apellido'];
                $email = $_POST['Email'];
                $pass = $_POST['Pass'];
                $rol = $_POST['TipoRol'];

                $resultado = $this->modelo->agregarUsuario($nombre, $apellido, $email, $pass, $rol);

                if ($resultado) {
                    header("Location: VIEW/Administrador/GestionUsuarios.php");
                    exit();
                } else {
                    echo "No se pudo registrar al usuario";
                }
            } else {
                echo "Uno de los campos está vacío";
            }
        }
    }

    public function agregarHorario() {
        if (!empty($_POST['Agregar'])) {
            if (!empty($_POST['Tipo']) && !empty($_POST['Hinicio']) && !empty($_POST['Hfin'])) {

                $Tipo = $_POST['Tipo'];
                $Hinicio = $_POST['Hinicio'];
                $Hfin = $_POST['Hfin'];

                $resultado = $this->modelo->agregarHorario($Tipo, $Hinicio, $Hfin);

                if ($resultado) {
                    header("Location: VIEW/Administrador/HorariosPoliticas.php");
                    exit();
                } else {
                    echo "No se pudo registrar al usuario";
                }
            } else {
                echo "Uno de los campos está vacío";
            }
        }
    }

    public function AgregarPausa() {
        if (!empty($_POST['Ingresar'])) {
            if (!empty($_POST['NombrePausa']) && !empty($_POST['Hinicio']) && !empty($_POST['Hfin'])) {

                $NombrePausa = $_POST['NombrePausa'];
                $Hinicio = $_POST['Hinicio'];
                $Hfin = $_POST['Hfin'];

                $resultado = $this->modelo->agregarPausa($NombrePausa, $Hinicio, $Hfin);

                if ($resultado) {
                    header("Location: VIEW/Administrador/HorariosPoliticas.php");
                    exit();
                } else {
                    echo "No se pudo registrar al usuario";
                }
            } else {
                echo "Uno de los campos está vacío";
            }
        }
    }
}
?>
