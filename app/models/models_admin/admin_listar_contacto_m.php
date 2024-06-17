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

function obtenerContactosEmergencia($id_alumno)
{
    global $conn; // Asumiendo que tienes una conexión a la base de datos establecida en otro archivo
    $stmt = $conn->prepare("SELECT id, nombre, apellido, email, tel, relacion FROM contacto WHERE id_alumno = :id_alumno");
    $stmt->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function eliminarContactoEmergencia($id_contacto)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM contacto WHERE id = :id_contacto");
    $stmt->bindParam(':id_contacto', $id_contacto, PDO::PARAM_INT);
    $stmt->execute();
}

function agregarContactoEmergencia($id_estudiante, $nombre, $apellido, $email, $tel, $relacion) {
    
    global $conn;

    // Preparar la consulta SQL
    try {
        // Insertar el usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO contacto (nombre, apellido, email, tel, relacion, id_alumno) VALUES (:nombre, :apellido, :email, :tel, :relacion, :id_alumno)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":apellido", $apellido);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":tel", $tel);
        $stmt->bindParam(":relacion", $relacion);
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