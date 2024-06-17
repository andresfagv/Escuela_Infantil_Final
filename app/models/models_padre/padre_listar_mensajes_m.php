<?php
require_once("../../db/db.php");

function getMensajesDeUnPadre($idPadre){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT mensajes.id, titulo, contenido, fecha_envio, visto, educador.nombre FROM mensajes JOIN educador ON mensajes.id_educador=educador.id WHERE mensajes.id_padre=:idPadre;");
        $stmt->bindParam(':idPadre', $idPadre);

        $stmt->execute();

        $array_mensajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_mensajes;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

?>