<?php
// login_c.php

require_once("../../db/db.php");

// Verifica si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    global $conn;
    try {
        $stmt = $conn->prepare('SELECT * FROM educador WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Obtener el resultado
        $educador = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error de conexión: ' . $e->getMessage();
    }
}



function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function editarEducador($nombre, $apellido, $email, $tel, $f_nacimiento, $sexo, $nombre_foto){
    global $conn;

    // Insertar el nuevo educador en la tabla educadores
    $stmt = $conn->prepare("UPDATE educador SET nombre = :nombre, apellido = :apellido, tel = :tel, f_nacimiento = :f_nacimiento, sexo = :sexo, img = :img WHERE email = :email");
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellido", $apellido);
    $stmt->bindParam(":tel", $tel);
    $stmt->bindParam(":f_nacimiento", $f_nacimiento);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->bindParam(":img", $nombre_foto);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    echo "Educador editado exitosamente.";
}




?>