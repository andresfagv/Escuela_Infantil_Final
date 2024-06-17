<?php

require_once("../../db/db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function datosEducador($email) {
    global $conn;
    try {
        // Preparar la consulta SQL
        $sql = "SELECT educador.* FROM users 
                JOIN educador ON educador.id_user = users.id 
                WHERE users.email = :email";
        $stmt = $conn->prepare($sql);

        // Vincular el parámetro
        $stmt->bindParam(':email', $email);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $array_educador = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $array_educador;
    } catch (Exception $e) {
        // Registrar el error
        error_log($e->getMessage());
        return false;
    }
}
?>
