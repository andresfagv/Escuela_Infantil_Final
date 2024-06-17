<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
require_once("../../models/models_padre/padre_page_m.php");
require_once("../../models/models_padre/padre_listar_mensajes_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';
$email_padre = $_SESSION['email'];

switch($action) {
    default:
        $array_alumno_padre = datos_Estudiante_Padre($email_padre);
        $_SESSION['nombre_padre'] = $array_alumno_padre[0]["nombre_padre"] . " " . $array_alumno_padre[0]["apellido_padre"];
        $_SESSION['id_padre']=$array_alumno_padre[0]['id_padre'];

        $arrayMensajesDePadre=getMensajesDeUnPadre($_SESSION['id_padre']);

        $_SESSION['nombre_alumno'] = $array_alumno_padre[0]["nombre_alumno"] . " " . $array_alumno_padre[0]["apellido_alumno"];
        $_SESSION['id_alumno'] = $array_alumno_padre[0]['id_alumno'];

        $_SESSION['nombre_clase'] = $array_alumno_padre[0]['nombre_clase'];
        $_SESSION['id_clase'] = $array_alumno_padre[0]['id_clase'];


        $menu = obtenerMenu($_SESSION['id_clase']);

        include '../../views/views_padre/padre_page_v.php';
        break;
}

?>
