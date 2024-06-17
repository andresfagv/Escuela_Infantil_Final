<?php
// login_c.php

require_once("../../db/db.php");


function obtenerClases()
{
    global $conn; // Asumiendo que tienes una conexión a la base de datos establecida en otro archivo
    $stmt = $conn->prepare("SELECT id, nombre, nivel FROM clase");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Asegúrate de tener una conexión establecida en $conn

function obtenerFotos($id_clase)
{
    global $conn; // Asumiendo que tienes una conexión a la base de datos establecida en otro archivo
    $stmt = $conn->prepare("SELECT id, ruta_foto, descripcion FROM fotografias WHERE id_clase = :id_clase");
    $stmt->bindParam(':id_clase', $id_clase, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function eliminarFoto($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM fotografias WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function crearFotografia($id_clase, $descripcion, $nombre_foto_extension){
    global $conn;

    try {
        // Insertar el padre en la base de datos
        $stmt = $conn->prepare("INSERT INTO fotografias (id_clase, ruta_foto, descripcion) VALUES (:id_clase, :ruta_foto, :descripcion)");
        $stmt->bindParam(":id_clase", $id_clase);
        $stmt->bindParam(":ruta_foto", $nombre_foto_extension);
        $stmt->bindParam(":descripcion", $descripcion);

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