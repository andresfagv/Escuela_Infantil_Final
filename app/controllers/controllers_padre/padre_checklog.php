<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Verificar si el usuario está autenticado y es admin
if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'padre') {
    // Redirigir al login o a una página de error
    header("Location: ../../logout.php");
    exit();
}

?>