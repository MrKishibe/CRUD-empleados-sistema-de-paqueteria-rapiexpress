<?php
require_once 'models/Tienda.php';

class TiendaController {
    private $tiendaModel;

    public function __construct() {
        $this->tiendaModel = new Tienda();
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php');
            exit();
        }

        $tiendas = $this->tiendaModel->obtenerTodas();
        include 'views/tienda/tienda.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            $data = [
                'tracking' => trim($_POST['tracking']),
                'nombre_tienda' => trim($_POST['nombre_tienda']),
            ];

            $resultado = $this->tiendaModel->registrar($data);

            switch ($resultado) {
                case 'registro_exitoso':
                    $_SESSION['mensaje'] = 'Tienda registrada exitosamente';
                    $_SESSION['tipo_mensaje'] = 'success';
                    break;
                case 'tracking_existente':
                    $_SESSION['mensaje'] = 'El código de tracking ya está registrado';
                    $_SESSION['tipo_mensaje'] = 'error';
                    break;
                default:
                    $_SESSION['mensaje'] = 'Error al registrar la tienda';
                    $_SESSION['tipo_mensaje'] = 'error';
            }

            header('Location: index.php?c=tienda');
            exit();
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $required = ['id_tienda', 'tracking', 'nombre_tienda'];
            foreach ($required as $field) {
                if (empty($_POST[$field])) {
                    $_SESSION['mensaje'] = "Error: El campo $field es requerido";
                    $_SESSION['tipo_mensaje'] = 'error';
                    header('Location: index.php?c=tienda');
                    exit();
                }
            }

            $data = [
                'id_tienda' => (int)$_POST['id_tienda'],
                'tracking' => trim($_POST['tracking']),
                'nombre_tienda' => trim($_POST['nombre_tienda'])
            ];

            $resultado = $this->tiendaModel->actualizar($data);

            if ($resultado === true) {
                $_SESSION['mensaje'] = 'Tienda actualizada exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
            } elseif ($resultado === 'tracking_existente') {
                $_SESSION['mensaje'] = 'El tracking ya pertenece a otra tienda';
                $_SESSION['tipo_mensaje'] = 'error';
            } else {
                $_SESSION['mensaje'] = 'Error al actualizar la tienda';
                $_SESSION['tipo_mensaje'] = 'error';
            }

            header('Location: index.php?c=tienda');
            exit();
        }
    }
public function eliminar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        
        if (!isset($_POST['id_tienda'])) {
            $_SESSION['mensaje'] = 'ID de tienda no proporcionado';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: index.php?c=tienda');
            exit();
        }

        $id = (int)$_POST['id_tienda'];
        $resultado = $this->tiendaModel->eliminar($id);

        if ($resultado === true) {
            $_SESSION['mensaje'] = 'Tienda eliminada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
        } else {
            $error = $this->tiendaModel->getLastError();
            $_SESSION['mensaje'] = $error ?: 'Error al eliminar la tienda';
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: index.php?c=tienda');
        exit();
    }
}


    public function obtenerTienda() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tienda = $this->tiendaModel->obtenerPorId($id);
            header('Content-Type: application/json');
            echo json_encode($tienda);
            exit();
        }
    }
}
