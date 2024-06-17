<?php
// login_c.php

require_once("../../db/db.php");


function obtenerAlumnos()
{
    global $conn; // Asumiendo que tienes una conexión a la base de datos establecida en otro archivo
    $stmt = $conn->prepare("SELECT id, nombre, apellido FROM estudiante");
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

function obtenerDocumentos($id_alumno)
{
    global $conn; // Asumiendo que tienes una conexión a la base de datos establecida en otro archivo
    $stmt = $conn->prepare("SELECT id, nombre, ruta, descripcion FROM autorizacion WHERE id_alumno = :id_alumno");
    $stmt->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function eliminarDocumento($id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM autorizacion WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

function obtenerruta($id_estudiante, $nombre) {
    // Convertir el nombre a minúsculas y eliminar espacios
    $nombre_formateado = strtolower(str_replace(' ', '', $nombre));
    // Concatenar el nombre formateado con el ID del estudiante
    $ruta = $nombre_formateado . "_" . $id_estudiante;
    return $ruta;
}

function agregarDocumento($id_estudiante, $nombre, $ruta, $descripcion) {
    $ruta = obtenerruta($id_estudiante, $nombre);
    global $conn;

    // Preparar la consulta SQL
    try {
        // Insertar el usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO autorizacion (nombre, ruta, descripcion, id_alumno) VALUES (:nombre, :ruta, :descripcion, :id_alumno)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":ruta", $ruta);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->bindParam(":id_alumno", $id_estudiante);

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