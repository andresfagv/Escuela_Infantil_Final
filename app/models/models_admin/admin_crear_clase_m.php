<?php
// login_c.php

require_once("../../db/db.php");


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function nombreExists($nombre) {
    // función que verifica si el nombre existe
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM clase WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}

function crearMenu($nombre) {
    global $conn;

    try {
        // Buscar id de la clase por nombre
        $stmt = $conn->prepare("SELECT id FROM clase WHERE nombre = :nombre");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->execute();

        $idClase = $stmt->fetchColumn();

        if ($idClase) {
            // Definir el menú genérico
            $menu = [
                ['dia' => 'Lunes', 'comida1' => 'Lunes Comida 1', 'comida2' => 'Lunes Comida 2'],
                ['dia' => 'Martes', 'comida1' => 'Martes Comida 1', 'comida2' => 'Martes Comida 2'],
                ['dia' => 'Miércoles', 'comida1' => 'Miércoles Comida 1', 'comida2' => 'Miércoles Comida 2'],
                ['dia' => 'Jueves', 'comida1' => 'Jueves Comida 1', 'comida2' => 'Jueves Comida 2'],
                ['dia' => 'Viernes', 'comida1' => 'Viernes Comida 1', 'comida2' => 'Viernes Comida 2']
            ];

            // Insertar el menú en la base de datos
            $stmtInsert = $conn->prepare("INSERT INTO menusemanal (id_clase, dia, comida1, comida2) VALUES (:id_clase, :dia, :comida1, :comida2)");

            foreach ($menu as $diaMenu) {
                $stmtInsert->bindParam(":id_clase", $idClase);
                $stmtInsert->bindParam(":dia", $diaMenu['dia']);
                $stmtInsert->bindParam(":comida1", $diaMenu['comida1']);
                $stmtInsert->bindParam(":comida2", $diaMenu['comida2']);
                $stmtInsert->execute();
            }

            echo "Menú creado con éxito para la clase '$nombre'\n";
        } else {
            echo "No se encontró una clase con el nombre '$nombre'\n";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function crearClase($nombre, $nivel, $descripcion){
    global $conn;

    // Verificar si el nombre ya existe en la tabla clase
    if (nombreExists($nombre)) {
        echo "Error: El nombre ya está registrado.";
        return;
    }

    try {
        // Insertar la nueva clase
        $stmt = $conn->prepare("INSERT INTO clase (nombre, nivel, descripcion) VALUES (:nombre, :nivel, :descripcion)");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":nivel", $nivel);
        $stmt->bindParam(":descripcion", $descripcion);
        $stmt->execute();
    
        echo "Clase creada exitosamente.";

        crearMenu($nombre);
        echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_clase_c.php';</script>";

    } catch (Exception $e) {
        error_log($e->getMessage());
    }
}



?>