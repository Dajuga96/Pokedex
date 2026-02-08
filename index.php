<?php
require_once 'autoload.php';
session_start();

$gestor = new GestorPokemon();
$controller = new PokedexController($gestor);

$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'crear':
        $controller->crear();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;    
    default:
      $controller->index();
}



?>