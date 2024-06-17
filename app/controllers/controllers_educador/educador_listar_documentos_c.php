<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_listar_documentos_m.php");


$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$id_estudiante = isset($_GET['id_estudiante']) ? test_input($_GET['id_estudiante']) : '';

if ($id_estudiante) {
    $documentos = obtenerDocumentos($id_estudiante);
    if ($documentos) {
        // Construir la tabla HTML para mostrar los documentos
        echo '<br><table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Titulo</th>';
        echo '<th>Descripcion</th>';
        echo '<th>PDF</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($documentos as $documento) {
            $ruta_pdf = '../../../media/files/documentos/' . $id_estudiante . '/' . $documento['ruta'] . '.pdf';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($documento['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($documento['descripcion']) . '</td>';
            echo '<td><a href="' . htmlspecialchars($ruta_pdf) . '" target="_blank"><img src="../../../public/img/pdf.png" alt="Ver PDF" ></a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay Documentos para este estudiante.</p>';
    }
}


switch ($action) {
    default:
        if (!$id_estudiante) {
            $alumnos = obtenerAlumnos();
            include '../../views/views_educador/educador_listar_documentos_v.php';
        }
        break;
}
