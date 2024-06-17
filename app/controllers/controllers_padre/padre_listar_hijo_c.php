<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
require_once("../../models/models_padre/padre_listar_hijo_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id_estudiante = $_SESSION['id_alumno'];

switch($action) {
    default:
        $datos =  obtenerDatosEstudiante($id_estudiante);
        include '../../views/views_padre/padre_listar_hijo_v.php';
        break;
}

?>
