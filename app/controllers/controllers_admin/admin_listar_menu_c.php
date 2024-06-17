<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_menu_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $aux = deleteClaseById($id);
            header('Location: admin_listar_manu_c.php');
        }
        break;
    default:
        $clases = getAllClases();
        
        include '../../views/views_admin/admin_listar_menu_v.php';
        break;
}


