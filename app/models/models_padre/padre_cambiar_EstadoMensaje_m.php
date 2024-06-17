<?php
require_once("../../db/db.php");

function cambiarEstadoMensaje($idMensaje){
    global $conn;
    try {
        $stmt = $conn->prepare("UPDATE mensajes SET visto = 1 WHERE mensajes.id = :idMEnsaje;");
        $stmt->bindParam(':idMEnsaje', $idMensaje);

        $stmt->execute();

        return true;
        //return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

?>