<?php

require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function datos_Estudiante_Padre($email)
{
    global $conn;
    try {
        // Preparar la consulta SQL
        $sql = "SELECT padre.id AS id_padre, padre.nombre AS nombre_padre, padre.apellido AS apellido_padre, 
		    estudiante.id AS id_alumno, estudiante.nombre AS nombre_alumno, estudiante.apellido AS apellido_alumno,
            clase.id AS id_clase, clase.nombre AS nombre_clase
            FROM padre, estudiante, users, inscripcion, clase 
			Where clase.id = inscripcion.id_clase AND inscripcion.id_estudiante = estudiante.id AND estudiante.id = padre.id_alumno AND padre.id_user = users.id AND users.email = :email";
        $stmt = $conn->prepare($sql);

        // Vincular el parámetro
        $stmt->bindParam(':email', $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $array_alumno_padre = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_alumno_padre;
    } catch (Exception $e) {
        // Registrar el error
        error_log($e->getMessage());
        return false;
    }
}

function obtenerPadresDeUnaClase()
{
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM padre");


        $stmt->execute();


        //return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function obtenerMenu($id_clase)
{
    global $conn;
    try {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM escuela_infantil.menusemanal where id_clase = :id_clase";
        $stmt = $conn->prepare($sql);

        // Vincular el parámetro
        $stmt->bindParam(':id_clase', $id_clase);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $menu;
    } catch (Exception $e) {
        // Registrar el error
        error_log($e->getMessage());
        return false;
    }
}
