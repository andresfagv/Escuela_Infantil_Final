<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_alumno_m.php");
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch($action) {
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            deleteEstudianteById($id);
            header('Location: admin_listar_alumnos_c.php');
        }
        break;
    default:
        $datos_estudiantes = getAllDatosEstudiantes();
        include '../../views/views_admin/admin_listar_alumno_v.php';
        break;
}

?>


