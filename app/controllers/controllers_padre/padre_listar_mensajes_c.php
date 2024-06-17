<?php
require_once("../../models/models_padre/padre_listar_mensajes_m.php");
session_start();
$arrayMensajesDePadre=getMensajesDeUnPadre($_SESSION['id_padre']);

include '../../views/views_padre/padre_listar_mensajes_v.php';

?>