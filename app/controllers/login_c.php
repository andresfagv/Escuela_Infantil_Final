<?php
// Iniciar sesión al principio
session_start();

// Iniciar el buffering de salida
ob_start();

//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("../models/login_m.php");

// Verificar si los datos del formulario están configurados
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['usertype'])) {
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $usertype = test_input($_POST['usertype']);

    // Intentar iniciar sesión
    $resultado = login($password, $email);

    // Verificar el resultado del login
    if ($resultado && $resultado['tipo_usuario'] == $usertype) {
        $_SESSION['usertype'] = $usertype;
        $_SESSION['email'] = $email;

        // Redirigir al usuario según su tipo de usuario
        switch ($usertype) {
            case 'admin':
                header("Location: ../views/views_admin/admin_page_v.php");
                exit();
            case 'educador':
                header("Location: ../controllers/controllers_educador/educador_page_c.php");
                exit();
            case 'padre':
                header("Location: ../controllers/controllers_padre/padre_page_c.php");
                exit();
        }
    } else {
        // Establecer variable de sesión para el error y redirigir al login
        $_SESSION['login_error'] = 'Correo electrónico o contraseña incorrectos.';
        header("Location: ../../index.php");
        exit();
    }
} else {
    // Redirigir al login si no se enviaron los datos necesarios
    $_SESSION['login_error'] = 'Por favor complete todos los campos.';
    header("Location: ../../index.php");
    exit();
}

// Enviar el contenido del buffer al navegador
ob_end_flush();
?>
