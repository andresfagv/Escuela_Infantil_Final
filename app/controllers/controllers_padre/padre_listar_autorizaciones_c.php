<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
require_once("../../models/models_padre/padre_listar_autorizaciones_m.php");

// Iniciar el búfer de salida
ob_start();

$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$id_estudiante = $_SESSION['id_alumno'];

switch ($action) {
    case 'delete':
        $id = isset($_GET['id']) ? test_input($_GET['id']) : '';
        if ($id) {
            eliminarDocumento($id);
            header('Location: ../../controllers/controllers_padre/padre_listar_autorizaciones_c.php');
            exit();
        }
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = test_input($_POST['nombre']);
            $descripcion = test_input($_POST['descripcion']);
            $pdf = $_FILES['pdf'];

            // Verificar que se haya seleccionado un archivo y sea PDF
            if ($pdf['error'] === UPLOAD_ERR_OK && $pdf['type'] === 'application/pdf') {
                $upload_dir = '../../../media/files/autorizacion/' . $id_estudiante;

                // Verificar si la carpeta existe, si no, crearla
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }

                $ruta = obtenerruta($id_estudiante, $nombre) . '.pdf';
                $upload_path = $upload_dir . '/' . $ruta;

                // Mover el archivo subido a la ruta de destino
                if (move_uploaded_file($pdf['tmp_name'], $upload_path)) {
                    // Llamar a la función agregarDocumento para insertar los datos en la base de datos
                    if (agregarDocumento($id_estudiante, $nombre, $ruta, $descripcion)) {
                        echo "Documento subido y registrado correctamente.";
                    } else {
                        echo "Error al registrar el documento en la base de datos.";
                    }
                } else {
                    echo "Error al mover el archivo subido.";
                }
            } else {
                echo "Por favor, suba un archivo PDF válido.";
            }

            header('Location: ../../controllers/controllers_padre/padre_listar_autorizaciones_c.php');
            exit();
        }
        break;
    default:
        include '../../views/views_padre/padre_listar_autorizaciones_v.php';
        break;
}

// Vaciar el búfer de salida y enviar la salida al navegador
ob_end_flush();
?>
