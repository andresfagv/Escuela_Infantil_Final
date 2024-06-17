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
    $stmt = $conn->prepare("SELECT id, nombre, ruta, descripcion FROM documentos WHERE id_alumno = :id_alumno");
    $stmt->bindParam(':id_alumno', $id_alumno, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>