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


?>