<?php

require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function obtenerMenu($id_clase){
    global $conn;
    try {
        // Preparar la consulta SQL
        $sql = "SELECT * FROM menusemanal where id_clase = :id_clase";
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
?>
