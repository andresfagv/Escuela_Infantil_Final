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

function crearPassword($email, $dni){
    // Obtener la parte del correo electrónico antes del símbolo '@'
    $email_part = explode('@', $email)[0];
    
    // Obtener los primeros 5 dígitos del DNI
    $dni_part = substr($dni, 0, 5);
    
    // Concatenar las partes para crear la contraseña
    $password = $email_part . $dni_part;
    
    return $password;
}

function crearUser($password, $email){
    // Generar un salt aleatorio
    $password_salt = bin2hex(random_bytes(16)); // Salt de 16 bytes en hexadecimal

    // Combinar el salt con la contraseña y hacer el hashing
    $password_hash = hash('sha256', $password . $password_salt);

    $rol = 'educador';

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

function crearEducador($nombre, $apellido, $dni, $email, $tel, $f_nacimiento, $sexo, $nombre_foto){
    global $conn;

    // Verificar si el email ya existe en la tabla users
    if (!emailExists($email)) {
        echo "Error: El correo electrónico proporcionado no está registrado.";
        return;
    }

    // Obtener el id_user correspondiente al email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $id_user = $stmt->fetchColumn();

    // Insertar el nuevo educador en la tabla educadores
    $stmt = $conn->prepare("INSERT INTO educador (id_user, nombre, apellido, DNI, email, tel, f_nacimiento, sexo, img) VALUES (:id_user, :nombre, :apellido, :dni, :email, :tel, :f_nacimiento, :sexo, :img)");
    $stmt->bindParam(":id_user", $id_user);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":apellido", $apellido);
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":tel", $tel);
    $stmt->bindParam(":f_nacimiento", $f_nacimiento);
    $stmt->bindParam(":sexo", $sexo);
    $stmt->bindParam(":img", $nombre_foto);
    $stmt->execute();

    echo "Educador creado exitosamente.";
}




?>