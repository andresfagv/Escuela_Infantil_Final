<?php
require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getMensajesDeUnEducador($idEducador){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT DISTINCT titulo, contenido, fecha_envio, educador.nombre  FROM mensajes, educador WHERE mensajes.id_educador=:idEducador and educador.id=:idEducador");
        $stmt->bindParam(':idEducador', $idEducador);

        $stmt->execute();

        $array_mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_mensajes;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
?>