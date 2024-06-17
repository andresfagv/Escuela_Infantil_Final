<?php
require_once("../../models/models_admin/admin_listar_educadores_m.php");

$idClase = isset($_GET['id']) ? $_GET['id'] : '';





function obtenerNombreClase($idClase) {
    // Datos de conexión a la base de datos
    global $conn;

    try {
        // Preparar la consulta para obtener el nombre de la clase por id
        $stmt = $conn->prepare("SELECT nombre FROM clase WHERE id = :idClase");
        $stmt->bindParam(":idClase", $idClase);
        $stmt->execute();

        // Obtener el resultado
        $nombreClase = $stmt->fetchColumn();

        return $nombreClase;

    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }

    // Cerrar conexión
    $conn = null;
}


function obtenerMenuPorClase($idClase) {
    global $conn;

    try {
        // Preparar la consulta para obtener los datos del menú por id_clase
        $stmt = $conn->prepare("SELECT dia, comida1, comida2 FROM menusemanal WHERE id_clase = :id_clase");
        $stmt->bindParam(":id_clase", $idClase, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener todos los resultados
        $menu = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $menu;

    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}



?>
