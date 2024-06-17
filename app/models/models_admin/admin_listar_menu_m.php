<?php

require_once("../../db/db.php");
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function getAllClases() {
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT * FROM clase");
        $stmt->execute();
        $array_clases = $stmt->FetchAll(PDO::FETCH_ASSOC);
        return $array_clases;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


?>
