<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_listar_alumno_m.php");

$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$idClase = isset($_GET['idClase']) ? test_input($_GET['idClase']) : '';

if ($idClase) {
    $datos_estudiantes = getAllDatosEstudiantesByClase($idClase);
    if ($datos_estudiantes) {
        echo '<table class="table table-hover">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Foto</th>';
        echo '<th>Nombre</th>';
        echo '<th>Fecha Nacimiento</th>';
        echo '<th>Clase</th>';
        echo '<th>Tutor Legal</th>';
        echo '<th>Telef. Contacto</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        if ($datos_estudiantes) {
            foreach ($datos_estudiantes as $dato_estudiante) {
                echo '<tr>';
                echo '<td class="img-td"><img src="' . '../../../media/avatar/alumno/' . $dato_estudiante['img'] . '" alt="Foto" class="img-responsive" /></td>';
                echo '<td><a href="../../controllers/controllers_educador/educador_datos_alumno_c.php?id=' . $dato_estudiante['id_estudiante'] . '">' . $dato_estudiante['nombre_estudiante'] . ' ' . $dato_estudiante['apellido_estudiante'] . '</a></td>';
                echo '<td>' . $dato_estudiante['f_nacimiento'] . '</td>';
                echo '<td>' . $dato_estudiante['nombre_clase'] . '</td>';
                echo '<td>' . $dato_estudiante['nombres_padres'] . ' <br>' . $dato_estudiante['apellidos_padres'] . '</td>';
                echo '<td>' . $dato_estudiante['telefonos_padres'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">No hay estudiantes disponibles.</td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay estudiantes para la clase seleccionada</p>';
    }
}

switch ($action) {
    default:
        if (!$idClase) {
            $clases = obtenerClases();
            include '../../views/views_educador/educador_listar_alumno_v.php';
        }
        break;
}
?>
