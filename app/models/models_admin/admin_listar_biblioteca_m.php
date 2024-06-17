<?php

require_once("../../db/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllProductos() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM productos");
        $stmt->execute();
        $array = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


function deleteProductoById($id) {
    global $conn;
    try {
        $stmt = $conn->prepare("DELETE FROM productos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        // Manejar cualquier error
        error_log($e->getMessage());
        return false; // Devolver false en caso de error
    }
}


function agregarArticulo($nombre, $tipo, $descripcion) {
    
    global $conn;

    // Preparar la consulta SQL
    try {
        // Insertar el usuario en la base de datos

        $disponible = true;

        $stmt = $conn->prepare("INSERT INTO productos (nombre, tipo, descripcion, disponible) VALUES (:nombre, :tipo, :descripcion, :disponible)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":disponible", $disponible);


        if ($stmt->execute()) {
            return $conn->lastInsertId(); // Devuelve el ID del nuevo registro insertado
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}


?>
