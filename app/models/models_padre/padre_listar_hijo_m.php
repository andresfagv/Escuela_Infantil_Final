<?php

require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function obtenerDatosEstudiante($id_estudiante) {
    global $conn;
    try {
        $sql = "SELECT estudiante.nombre AS nombre_estudiante, estudiante.apellido AS apellido_estudiante, estudiante.f_nacimiento, estudiante.sexo AS sexo_estudiante,
                       estudiante.alergias, estudiante.comentarios, estudiante.img, padre.nombre AS nombre_padre, padre.apellido AS apellido_padre, 
                       padre.email AS email_padre, padre.tel AS tel_padre, padre.relacion, padre.sexo AS sexo_padre, padre.DNI, 
                       inscripcion.id_clase AS id_curso
                FROM estudiante
                INNER JOIN padre ON padre.id_alumno = estudiante.id 
                INNER JOIN inscripcion ON inscripcion.id_estudiante = estudiante.id 
                WHERE estudiante.id = :id_estudiante";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_estudiante', $id_estudiante, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}
function ObtenerCursos() {
    global $conn;
    try {
        $sql = "SELECT id, nombre FROM clase";
        $stmt = $conn->query($sql);
        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cursos;
    } catch (PDOException $e) {
        error_log("Error al obtener cursos: " . $e->getMessage());
        return false;
    }
}
?>
