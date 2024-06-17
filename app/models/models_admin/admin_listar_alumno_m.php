<?php

require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllDatosEstudiantes()
{
    global $conn;
    try {
        $sql = "SELECT
        e.id,
    e.img,
    e.nombre AS nombre_estudiante,
    e.apellido AS apellido_estudiante,
    e.f_nacimiento AS f_nacimiento,
    c.nombre AS Clase,
    GROUP_CONCAT(CONCAT(p.nombre, ' ', p.apellido, ' (', p.relacion, ')') SEPARATOR ' || ') AS 'Tutor Legal',
    GROUP_CONCAT(p.tel SEPARATOR ' || ') AS 'Telef. Contacto'
FROM 
    estudiante e
LEFT JOIN 
    inscripcion i ON e.id = i.id_estudiante
LEFT JOIN 
    clase c ON i.id_clase = c.id
LEFT JOIN 
    padre p ON e.id = p.id_alumno
GROUP BY 
    e.id;
";

        $stmt = $conn->query($sql);
        $array_estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_estudiantes;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}



function deleteEstudianteById($id)
{
    global $conn;
    try {
        // Ahora, elimina el registro de la tabla users usando el user_id obtenido
        $stmt = $conn->prepare("DELETE FROM estudiante WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        // Manejar cualquier error
        error_log($e->getMessage());
        return false; // Devolver false en caso de error
    }
}


?>