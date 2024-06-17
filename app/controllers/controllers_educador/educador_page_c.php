<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_page_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';
$email_educador = $_SESSION['email'];

switch($action) {
    default:
        $educador = datosEducador($email_educador);
        $_SESSION['nombre'] = $educador[0]["nombre"] . " " . $educador[0]["apellido"];
        $_SESSION['img'] = $educador[0]['img'];
        $_SESSION['id_educador'] = $educador[0]['id'];
        include '../../views/views_educador/educador_page_v.php';
        break;
}

?>


