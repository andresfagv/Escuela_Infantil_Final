<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_educadores_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $aux = deleteEducadorById($id);
            header('Location: admin_listar_educadores_c.php');
        }
        break;
    default:
        $educadores = getAllEducadores();
        
        include '../../views/views_admin/admin_listar_educadores_v.php';
        break;
}

?>


