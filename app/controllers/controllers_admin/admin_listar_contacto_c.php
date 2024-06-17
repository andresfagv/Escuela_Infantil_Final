<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_contacto_m.php");

// Iniciar el buffering de salida
ob_start();

$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$id_estudiante = isset($_GET['id_estudiante']) ? test_input($_GET['id_estudiante']) : '';

if ($id_estudiante) {
    $contactos_emergencia = obtenerContactosEmergencia($id_estudiante);
    if ($contactos_emergencia) {
        // Construir la tabla HTML para mostrar los contactos de emergencia
        echo '<br><table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Nombre</th>';
        echo '<th>Teléfono</th>';
        echo '<th>Relación</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($contactos_emergencia as $contacto) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($contacto['nombre'] . " " . $contacto['apellido']) . '</td>';
            echo '<td>' . htmlspecialchars($contacto['tel']) . '</td>';
            echo '<td>' . htmlspecialchars($contacto['relacion']) . '</td>';
            echo '<td><a href="../../controllers/controllers_admin/admin_listar_contacto_c.php?action=delete&id=' . $contacto['id'] . '&id_estudiante=' . $id_estudiante . '" onclick="return confirmarEliminacion();">Eliminar</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay contactos de emergencia para este estudiante.</p>';
    }
}

switch ($action) {
    case 'delete':
        $id = isset($_GET['id']) ? test_input($_GET['id']) : '';
        if ($id) {
            eliminarContactoEmergencia($id);
            // Limpiar el buffer de salida y redirigir
            ob_end_clean();
            header('Location: ../../controllers/controllers_admin/admin_listar_contacto_c.php');
            exit();
        }
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_estudiante = test_input($_POST['id_estudiante']);
            $nombre = test_input($_POST['nombre']);
            $apellido = test_input($_POST['apellido']);
            $email = test_input($_POST['email']);
            $tel = test_input($_POST['tel']);
            $relacion = test_input($_POST['relacion']);
            agregarContactoEmergencia($id_estudiante, $nombre, $apellido, $email, $tel, $relacion);
            // Limpiar el buffer de salida y redirigir
            ob_end_clean();
            header('Location: ../../controllers/controllers_admin/admin_listar_contacto_c.php');
            exit();
        }
        break;
    default:
        if (!$id_estudiante) {
            $alumnos = obtenerAlumnos();
            include '../../views/views_admin/admin_listar_contacto_v.php';
        }
        break;
}

// Enviar el contenido del buffer al navegador
ob_end_flush();
?>
