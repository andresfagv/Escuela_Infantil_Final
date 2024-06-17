<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_listar_contactos_m.php");


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
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($contactos_emergencia as $contacto) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($contacto['nombre'] . " " . $contacto['apellido']) . '</td>';
            echo '<td>' . htmlspecialchars($contacto['tel']) . '</td>';
            echo '<td>' . htmlspecialchars($contacto['relacion']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay contactos de emergencia para este estudiante.</p>';
    }
    
}

switch ($action) {
    default:
        if (!$id_estudiante) {
            $alumnos = obtenerAlumnos();
            include '../../views/views_educador/educador_listar_contactos_v.php';
        }
        break;
}
?>
