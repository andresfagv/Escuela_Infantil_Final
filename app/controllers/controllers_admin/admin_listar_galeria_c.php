<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_listar_galeria_m.php");


$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
$idClase = isset($_GET['idClase']) ? test_input($_GET['idClase']) : '';

if ($idClase) {
    $fotos = obtenerFotos($idClase);
    if ($fotos) {
        // Construir la tabla HTML para mostrar los contactos de emergencia
        echo '<br><table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Foto</th>';
        echo '<th>Descripcion</th>';
        echo '<th>Eliminar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($fotos as $foto) {
            echo '<tr>';
            echo '<td class="img-td"><img src="' . '../../../media/galeria/' . $foto['ruta_foto'] . '" alt="Foto" class="img-responsive" /></td>';
            echo '<td>' . htmlspecialchars($foto['descripcion']) . '</td>';
            echo '<td><a href="../../controllers/controllers_admin/admin_listar_galeria_c.php?action=delete&id=' . $foto['id'] . '&id_clase=' . $idClase . '" onclick="return confirmarEliminacion();">Eliminar</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>No hay fotos para la clase seleccionada</p>';
    }
}

switch ($action) {
    case 'delete':
        $id = isset($_GET['id']) ? test_input($_GET['id']) : '';
        if ($id) {
            eliminarFoto($id);
            header('Location: ../../controllers/controllers_admin/admin_listar_galeria_c.php');
            exit();
        }
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_clase = test_input($_POST['id_clase']);
            $descripcion = test_input($_POST['descripcion']);

            $seguir = true;

            if ($seguir) {
                $target_dir = "../../../media/galeria/"; // Carpeta de destino
                $nombre_foto = trim($id_clase) . "-" . date("Y-m-d_H-i-s");
                // Obtener la extensión del archivo subido
                $extension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

                // Combinar el nombre base con ambas extensiones
                $target_file_jpg = $target_dir . $nombre_foto . ".jpg";
                $target_file_png = $target_dir . $nombre_foto . ".png";

                // Mover la foto a la carpeta de destino con la nueva extensión
                if ($extension == "jpg" || $extension == "jpeg") {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file_jpg)) {
                        echo "La foto ha sido subida con éxito.";
                        $nombre_foto_extension = $nombre_foto . ".jpg";
                    } else {
                        echo "Lo siento, hubo un error al subir la foto.";
                        $seguir = false;
                    }
                } elseif ($extension == "png") {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file_png)) {
                        echo "La foto ha sido subida con éxito.";
                        $nombre_foto_extension = $nombre_foto . ".png";
                    } else {
                        echo "Lo siento, hubo un error al subir la foto.";
                        $seguir = false;
                    }
                } else {
                    echo "Formato de imagen no compatible. Solo se admiten archivos JPG o PNG.";
                    $seguir = false;
                }
            }
            if ($seguir) {
                crearFotografia($id_clase, $descripcion, $nombre_foto_extension);
                echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_galeria_c.php';</script>";
            }


            
        }
        break;
    default:
        if (!$idClase) {
            $clases = obtenerClases();
            include '../../views/views_admin/admin_listar_galeria_v.php';
        }
        break;
}
