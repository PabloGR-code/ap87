<?php
require_once "autoload.php";
session_start();

$gestor=new GestorPDO();
$productoController = new VehiculoController($gestor);
$usuarioController = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'login':
        $usuarioController->login();
        break;
    case 'registro':
        $usuarioController->registro();
        break;
    case 'logout':
        $usuarioController->logout();
        break;
    case 'crear':
    case 'editar':
    case 'eliminar':
        if (!isset($_SESSION['usuarioId'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        if ($accion === 'crear') $productoController->crear();
        if ($accion === 'editar') $productoController->editar();
        if ($accion === 'eliminar') $productoController->eliminar();
        break;
    default:
        $productoController->index();
}
