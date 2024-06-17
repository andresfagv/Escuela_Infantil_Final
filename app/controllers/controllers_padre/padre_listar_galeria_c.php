<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
require_once("../../models/models_padre/padre_listar_galeria_m.php");

// Check if session variable 'id_clase' is set
if (!isset($_SESSION['id_clase'])) {
    echo '<p>Error: No se ha seleccionado una clase.</p>';
    exit();
}

$idClase = $_SESSION['id_clase'];
$action = isset($_GET['action']) ? test_input($_GET['action']) : '';
include '../../views/views_padre/padre_listar_galeria_v.php';


function imprimirFotos($idClase){
    if ($idClase) {
        // Fetch photos for the class
        $fotos = obtenerFotos($idClase);
        echo '<div id="fotos">'; // Start of the div with id "fotos"
        if ($fotos) {
            echo '<br><table class="table">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Foto</th>';
            echo '<th>Descripcion</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($fotos as $foto) {
                echo '<tr>';
                echo '<td class="img-td"><img src="' . '../../../media/galeria/' . htmlspecialchars($foto['ruta_foto']) . '" alt="Foto" class="img-responsive" /></td>';
                echo '<td>' . htmlspecialchars($foto['descripcion']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Todavía no hay fotos!! Próximamente...</p>';
        }
        echo '</div>'; // End of the div with id "fotos"
    }
}

