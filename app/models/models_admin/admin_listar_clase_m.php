<?php

require_once("../../db/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllClases() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM clase");
        $stmt->execute();
        $array_clases = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


function deleteClaseById($id) {
    global $conn;
    try {
            $stmt = $conn->prepare("DELETE FROM clase WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se eliminó correctamente (devuelve true si se eliminó al menos una fila)
            return $stmt->rowCount() > 0;
    } catch (Exception $e) {
        // Manejar cualquier error
        error_log($e->getMessage());
        return false; // Devolver false en caso de error
    }
}

?>
