<?php
// Obtener controlador y acción desde $_GET con valores por defecto
$c = $_GET['c'] ?? 'auth';
$a = $_GET['a'] ?? 'login';

// Controlador y método genéricos
$controllerName = ucfirst($c) . 'Controller';
$method = $a;

if ($c === 'tienda') {
    $controllerFile = "controllers/{$controllerName}.php";
    if (!file_exists($controllerFile)) {
        die("Archivo del controlador '$controllerFile' no encontrado.");
    }
    require_once $controllerFile;

    if (!class_exists($controllerName)) {
        die("Controlador '$controllerName' no encontrado.");
    }

    $tiendaController = new $controllerName();

    switch ($a) {
        case 'index':
            $tiendaController->index();
            break;
        case 'registrar':
            $tiendaController->registrar();
            break;
        case 'editar':
            $tiendaController->editar();
            break;
        case 'eliminar':
            $tiendaController->eliminar();
            break;
        case 'obtenerTienda':
            $tiendaController->obtenerTienda();
            break;
        default:
            $tiendaController->index();
            break;
    }

} else {

    $controllerFile = "controllers/{$controllerName}.php";

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $method)) {
                $controller->$method();
            } else {
                die("Método '$method' no encontrado en el controlador '$controllerName'");
            }
        } else {
            die("Controlador '$controllerName' no encontrado.");
        }
    } else {
        die("Archivo del controlador '$controllerFile' no encontrado.");
    }
}

