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

function pintarMenu($menu){
    echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Día</th>';
        echo '<th>Comida 1</th>';
        echo '<th>Comida 2</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($menu as $dia) {
            echo '<tr>';
            echo '<td>' . $dia["dia"] . '</td>';
            echo '<td>' . $dia["comida1"] . '</td>';
            echo '<td>' . $dia["comida2"] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
}

?>