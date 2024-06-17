<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_biblioteca_m.php");

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'delete':
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id) {
            $aux = deleteProductoById($id);
            header('Location: admin_listar_biblioteca_c.php');
        }
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = test_input($_POST['nombre']);
            $tipo = test_input($_POST['tipo']);
            $descripcion = test_input($_POST['descripcion']);

            agregarArticulo($nombre, $tipo, $descripcion);
            header('Location: ../../controllers/controllers_admin/admin_listar_biblioteca_c.php');
            exit();
        }
    default:
        $productos = getAllProductos();

        include '../../views/views_admin/admin_listar_biblioteca_v.php';
        break;
}

?>


