<?php

require_once("../../db/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllProductosDisponible() {
    global $conn;
    $disponible = true;
    try {
        $stmt = $conn->prepare("SELECT * FROM productos Where disponible=:disponible");
        $stmt->bindParam(":disponible", $disponible);
        $stmt->execute();
        $array = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function getAllProductosNODisponible() {
    global $conn;
    $disponible = false;
    try {
        $stmt = $conn->prepare("SELECT * FROM productos Where disponible=:disponible");
        $stmt->bindParam(":disponible", $disponible);
        $stmt->execute();
        $array = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}



function getAllEstudiantes()
{
    global $conn;
    try {
        $sql = "SELECT id, nombre, apellido FROM estudiante";

        $stmt = $conn->query($sql);
        $array_estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_estudiantes;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}



function getNombreAlumno($id){
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT nombre, apellido FROM estudiante Where id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $array = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array[0]['nombre'].' '.$array[0]['apellido'];
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function devolverArticulo($id) {
    global $conn;
    $disponible = 1;
    try {
        // Actualizar el artículo en la base de datos
        $stmt = $conn->prepare("UPDATE productos SET disponible = :disponible, id_alumno = NULL WHERE id = :id");
        $stmt->bindParam(":disponible", $disponible);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true; // La actualización fue exitosa
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}


function alquilarArticulo($id, $id_alumno) {
    global $conn;
    $disponible = 0; // Establecer como no disponible
    try {
        // Actualizar el artículo en la base de datos
        $stmt = $conn->prepare("UPDATE productos SET disponible = :disponible, id_alumno = :id_alumno WHERE id = :id");
        $stmt->bindParam(":disponible", $disponible);
        $stmt->bindParam(":id_alumno", $id_alumno);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            return true; // La actualización fue exitosa
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
