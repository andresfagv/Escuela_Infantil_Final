<?php
// login_c.php

require_once("../../db/db.php");


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



function emailExists($email) {
    //funcion que verifica si el email existe
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if($count){
            return true;
        }else{
            return false;
        }
        
    } catch (Exception $e) {
        error_log($e->getMessage());
        return false;
    }
}


function crearUserAdmin($password, $email){
    // Generar un salt aleatorio
    $password_salt = bin2hex(random_bytes(16)); // Salt de 16 bytes en hexadecimal

    // Combinar el salt con la contraseña y hacer el hashing
    $password_hash = hash('sha256', $password . $password_salt);

    $rol = 'admin';

    global $conn;

    // Insertar el usuario en la base de datos
    $stmt = $conn->prepare("INSERT INTO users (email, password_hash, password_salt, tipo_usuario) VALUES (:email, :password_hash, :password_salt, :rol)");
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password_hash", $password_hash);
    $stmt->bindParam(":password_salt", $password_salt);
    $stmt->bindParam(":rol", $rol);
    $stmt->execute();

    echo "Usuario registrado exitosamente.";
}


?>