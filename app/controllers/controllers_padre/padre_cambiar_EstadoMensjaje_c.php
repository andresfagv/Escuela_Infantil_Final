<?php
require_once("../../models/models_padre/padre_listar_mensajes_m.php");
// Asegúrate de que el contenido recibido sea JSON
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);
// Obtén el contenido de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

$response = ['success' => false, 'error' => 'Invalid input'];

if (isset($data['idMensaje'])) {
    $idMensaje = $data['idMensaje'];
    $respuesta=cambiarEstadoMensaje($idMensaje);
    // Respuesta exitosa
    $response = [
        'success' => $respuesta,
        'idMensaje' => $idMensaje,
    ];
    
    
    
}

echo json_encode($response);
?>
