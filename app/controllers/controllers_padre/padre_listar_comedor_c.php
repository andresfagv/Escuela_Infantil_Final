<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
require_once("../../models/models_padre/padre_listar_comedor_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    default:

        $menu = obtenerMenu($_SESSION['id_clase']);

        include '../../views/views_padre/padre_listar_comedor_v.php';
        break;
}

?>
