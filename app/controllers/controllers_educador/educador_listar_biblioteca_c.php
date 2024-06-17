<?php
ob_start(); // Iniciar el almacenamiento en búfer de salida

require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_listar_biblioteca_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'alquilar':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_articulo = test_input($_POST['id_articulo']);
            $id_alumno = test_input($_POST['id_alumno']);

            if ($id_articulo && $id_alumno) {
                alquilarArticulo($id_articulo, $id_alumno);
                header('Location: ../../controllers/controllers_educador/educador_listar_biblioteca_c.php');
                exit;
            }
        }

        break;
    case 'devolver':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            devolverArticulo($id);
            header('Location: ../../controllers/controllers_educador/educador_listar_biblioteca_c.php');
            exit;
        }
        break;
    default:
        $productos_disponible = getAllProductosDisponible();
        $productos_no_disponible = getAllProductosNODisponible();
        $alumnos =  getAllEstudiantes();

        include '../../views/views_educador/educador_listar_biblioteca_v.php';
        break;
}

ob_end_flush(); // Liberar el contenido del búfer de salida y enviarlo al navegador
?>

