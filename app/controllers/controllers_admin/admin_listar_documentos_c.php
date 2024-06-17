<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_documentos_m.php");

// Iniciar el buffering de salida
ob_start();

$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$id_estudiante = isset($_GET['id_estudiante']) ? test_input($_GET['id_estudiante']) : '';

if ($id_estudiante) {
    $documentos = obtenerDocumentos($id_estudiante);
    if ($documentos) {
        // Construir la tabla HTML para mostrar los documentos
        echo '<br><table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Título</th>';
        echo '<th>Descripción</th>';
        echo '<th>PDF</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($documentos as $documento) {
            $ruta_pdf = '../../../media/files/documentos/' . $id_estudiante . '/' . $documento['ruta'] . '.pdf';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($documento['nombre']) . '</td>';
            echo '<td>' . htmlspecialchars($documento['descripcion']) . '</td>';
            echo '<td><a href="' . htmlspecialchars($ruta_pdf) . '" target="_blank"><img src="../../../public/img/pdf.png" alt="Ver PDF"></a></td>';
            echo '<td><a href="../../controllers/controllers_admin/admin_listar_documentos_c.php?action=delete&id=' . $documento['id'] . '&id_estudiante=' . $id_estudiante . '" onclick="return confirmarEliminacion();">Eliminar</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay documentos para este estudiante.</p>';
    }
}

switch ($action) {
    case 'delete':
        $id = isset($_GET['id']) ? test_input($_GET['id']) : '';
        if ($id) {
            eliminarDocumento($id);
            // Limpiar el buffer de salida y redirigir
            ob_end_clean();
            header('Location: ../../controllers/controllers_admin/admin_listar_documentos_c.php');
            exit();
        }
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_estudiante = test_input($_POST['id_estudiante']);
            $nombre = test_input($_POST['nombre']);
            $descripcion = test_input($_POST['descripcion']);
            $pdf = $_FILES['pdf'];

            // Verificar que el archivo es un PDF
            if ($pdf['type'] === 'application/pdf' && $pdf['error'] === UPLOAD_ERR_OK) {
                $upload_dir = '../../../media/files/documentos/' . $id_estudiante;

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

            // Limpiar el buffer de salida y redirigir
            ob_end_clean();
            header('Location: ../../controllers/controllers_admin/admin_listar_documentos_c.php');
            exit();
        }
        break;
    default:
        if (!$id_estudiante) {
            $alumnos = obtenerAlumnos();
            include '../../views/views_admin/admin_listar_documentos_v.php';
        }
        break;
}

// Enviar el contenido del buffer al navegador
ob_end_flush();
?>
