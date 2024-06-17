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
    // función que verifica si el nombre existe
    global $conn;
    try {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
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

function crearUser($password, $email) {
    // Generar un salt aleatorio
    $password_salt = bin2hex(random_bytes(16)); // Salt de 16 bytes en hexadecimal

    // Combinar el salt con la contraseña y hacer el hashing
    $password_hash = hash('sha256', $password . $password_salt);

    $rol = 'padre';

    global $conn;

    try {
        // Insertar el usuario en la base de datos
        $stmt = $conn->prepare("INSERT INTO users (email, password_hash, password_salt, tipo_usuario) VALUES (:email, :password_hash, :password_salt, :rol)");
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password_hash", $password_hash);
        $stmt->bindParam(":password_salt", $password_salt);
        $stmt->bindParam(":rol", $rol);

        if ($stmt->execute()) {
            return $conn->lastInsertId(); // Devuelve el ID del nuevo registro insertado
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function crearAlumno($nombre_alumno, $apellido_alumno, $f_nacimiento, $sexo_alumno, $alergias, $nombre_foto_extension, $comentarios) {
    global $conn;

    $sql = "INSERT INTO estudiante (nombre, apellido, f_nacimiento, sexo, alergias, img, comentarios) 
            VALUES (:nombre, :apellido, :f_nacimiento, :sexo, :alergias, :img, :comentarios)";
    
    try {
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->errorInfo()[2]);
        }

        $stmt->bindParam(':nombre', $nombre_alumno);
        $stmt->bindParam(':apellido', $apellido_alumno);
        $stmt->bindParam(':f_nacimiento', $f_nacimiento);
        $stmt->bindParam(':sexo', $sexo_alumno);
        $stmt->bindParam(':alergias', $alergias);
        $stmt->bindParam(':img', $nombre_foto_extension);
        $stmt->bindParam(':comentarios', $comentarios);

        if ($stmt->execute()) {
            return $conn->lastInsertId(); // Devuelve el ID del nuevo registro insertado
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->errorInfo()[2]);
        }
    } catch (PDOException $pdoe) {
        // Error de PDO (por ejemplo, problema de conexión)
        echo "Error de PDO: " . $pdoe->getMessage();
    } catch (Exception $e) {
        // Otros errores
        echo "Error: " . $e->getMessage();
    }

    return false; // En caso de error, retorna falso
}

function crearPadre($id_user, $nombre_padre, $apellido_padre, $email, $telefono, $relacion, $sexo_padre, $dni,  $id_alumno) {
    global $conn;

    try {
        // Insertar el padre en la base de datos
        $stmt = $conn->prepare("INSERT INTO padre (id_user, nombre, apellido, email, tel, id_alumno, relacion, sexo, dni) VALUES (:id_user, :nombre, :apellido, :email, :tel, :id_alumno, :relacion, :sexo, :dni)");
        $stmt->bindParam(":id_user", $id_user);
        $stmt->bindParam(":nombre", $nombre_padre);
        $stmt->bindParam(":apellido", $apellido_padre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":tel", $telefono);
        $stmt->bindParam(":id_alumno", $id_alumno);
        $stmt->bindParam(":relacion", $relacion);
        $stmt->bindParam(":sexo", $sexo_padre);
        $stmt->bindParam(":dni", $dni);

        if ($stmt->execute()) {
            return $conn->lastInsertId(); // Devuelve el ID del nuevo registro insertado
        } else {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}

function ObtenerCursos() {
    global $conn;
    try {
        $sql = "SELECT id, nombre FROM clase";
        $stmt = $conn->query($sql);
        $cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cursos;
    } catch (PDOException $e) {
        error_log("Error al obtener cursos: " . $e->getMessage());
        return false;
    }
}

function inscribirEstudianteEnClase($id_clase, $id_estudiante) {
    global $conn;

    try {
        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO inscripcion (id_clase, id_estudiante) VALUES (:id_clase, :id_estudiante)");

        // Vincular los parámetros
        $stmt->bindParam(':id_clase', $id_clase);
        $stmt->bindParam(':id_estudiante', $id_estudiante);

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se insertó correctamente
        if ($stmt->rowCount() > 0) {
            return true; // La inscripción se realizó con éxito
        } else {
            return false; // No se insertó ninguna fila (inscripción fallida)
        }
    } catch (PDOException $e) {
        // Capturar cualquier excepción de PDO
        error_log("Error al inscribir estudiante en clase: " . $e->getMessage());
        return false;
    }
}



?>