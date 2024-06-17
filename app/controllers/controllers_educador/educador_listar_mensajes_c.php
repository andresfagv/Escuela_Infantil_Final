<?php
session_start();
require_once("../../models/models_educador/educador_listar_mensajes_m.php");
$arrayMensajesDeEducador=getMensajesDeUnEducador($_SESSION['id_educador'] );

include '../../views/views_educador/educador_listar_mensajes_v.php';

?>