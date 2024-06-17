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


function getAllDatosEstudiantesByClase($idClase)
{
    global $conn;
    try {
        $sql = "SELECT estudiante.id AS id_estudiante, 
        estudiante.nombre AS nombre_estudiante, 
        estudiante.apellido AS apellido_estudiante, 
        clase.nombre AS nombre_clase, 
        estudiante.f_nacimiento, 
        estudiante.img,
        GROUP_CONCAT(padre.nombre SEPARATOR ', ') AS nombres_padres, 
        GROUP_CONCAT(padre.apellido SEPARATOR ', ') AS apellidos_padres, 
        GROUP_CONCAT(padre.tel SEPARATOR ', ') AS telefonos_padres
 FROM estudiante
 INNER JOIN padre ON padre.id_alumno = estudiante.id 
 INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id 
 INNER JOIN clase ON inscripcion.id_clase = clase.id
 WHERE clase.id = :idClase
 GROUP BY estudiante.id, estudiante.nombre, estudiante.apellido, clase.nombre, estudiante.f_nacimiento, estudiante.img";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idClase', $idClase, PDO::PARAM_INT);
        $stmt->execute();
        $array_estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_estudiantes;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}



?>