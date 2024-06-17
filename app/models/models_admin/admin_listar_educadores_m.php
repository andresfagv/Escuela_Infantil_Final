<?php

require_once("../../db/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllEducadores() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM educador");
        $stmt->execute();
        $array_educadores = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array_educadores;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


function deleteEducadorById($id) {
    global $conn;
    try {
        // Primero, obtén el user_id correspondiente al educador
        $stmt = $conn->prepare("SELECT id_user FROM educador WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['id_user'])) {
            $user_id = $result['id_user'];

            // Ahora, elimina el registro de la tabla users usando el user_id obtenido
            $stmt = $conn->prepare("DELETE FROM users WHERE id = :user_id");
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar si se eliminó correctamente (devuelve true si se eliminó al menos una fila)
            return $stmt->rowCount() > 0;
        } else {
            // No se encontró ningún user_id correspondiente al educador
            return false;
        }
    } catch (Exception $e) {
        // Manejar cualquier error
        error_log($e->getMessage());
        return false; // Devolver false en caso de error
    }
}

?>
