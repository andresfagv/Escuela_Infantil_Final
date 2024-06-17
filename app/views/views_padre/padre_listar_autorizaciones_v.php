<?php
require_once("../../controllers/controllers_padre/padre_checklog.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Familiar</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="../../../public/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../../../public/css/font-awesome.css" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="../../../public/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../../../public/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="icon" href="../../../public/img/icon.PNG" type="image/png">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../controllers/controllers_padre/padre_page_c.php">Panel Familiar</a>
            </div>
            <div style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;"><a href="../../logout.php" class="btn  square-btn-adjust">Cerrar Sesión</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="../../../public/img/feliz.png" class="user-image img-responsive" />
                    </li>

                    <li>
                        <a href="../../controllers/controllers_padre/padre_listar_hijo_c.php"><img src="../../../public/img/hijo.png"> Mi hijo</a>
                    </li>

                    <li>
                        <a href="../../controllers/controllers_padre/padre_listar_comedor_c.php"><img src="../../../public/img/menu.png"> Comedor</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_padre/padre_listar_galeria_c.php"><img src="../../../public/img/camara.png"> Galeria</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_padre/padre_listar_autorizaciones_c.php"><img src="../../../public/img/contrato.png"> Autorizaciones</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_padre/padre_listar_mensajes_c.php"><img src="../../../public/img/comunicados.png"> Mensajes</a>
                    </li>
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <?php
            if ($id_estudiante) {
                $documentos = obtenerDocumentos($id_estudiante);
                if ($documentos) {
                    // Construir la tabla HTML para mostrar los documentos
                    echo '<br><table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Titulo</th>';
                    echo '<th>Descripcion</th>';
                    echo '<th>PDF</th>';
                    echo '<th>Eliminar</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    foreach ($documentos as $documento) {
                        $ruta_pdf = '../../../media/files/autorizacion/' . $id_estudiante . '/' . $documento['ruta'] . '.pdf';
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($documento['nombre']) . '</td>';
                        echo '<td>' . htmlspecialchars($documento['descripcion']) . '</td>';
                        echo '<td><a href="' . htmlspecialchars($ruta_pdf) . '" target="_blank"><img src="../../../public/img/pdf.png" alt="Ver PDF" ></a></td>';
                        echo '<td><a href="../../controllers/controllers_padre/padre_listar_autorizaciones_c.php?action=delete&id=' . $documento['id'] . '&id_estudiante=' . $id_estudiante . '" onclick="return confirmarEliminacion();">Eliminar</a></td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay autorizaciones para este estudiante.</p>';
                }
            } ?>
            <div id="formularioContacto">
                <h2>Añadir Autorización</h2>
                <form method="POST" action="../../controllers/controllers_padre/padre_listar_autorizaciones_c.php?action=add" enctype="multipart/form-data">
                    <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante ?>" id="id_estudiante_hidden">
                    <ul class="nav nav-second-level">
                        <li class="form-group">
                            <label>Nombre / Título del Documento *</label>
                            <input class="form-control" id="nombre" name="nombre" placeholder="Ej: Documento Orden de Alejamiento" required maxlength="30" />
                        </li>
                        <li class="form-group">
                            <label>Descripcion *</label>
                            <input class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion del documento" required />
                        </li>
                        <li class="form-group">
                            <label>Archivo PDF *</label>
                            <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf" required />
                        </li>
                    </ul>
                    <button type="submit" class="btn btn-default">Enviar</button>
                    <button type="reset" class="btn btn-primary">Borrar Datos</button>
                </form>

            </div>
        </div>

    </div>

    <script src="../../../public/js/jquery-1.10.2.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>
    <script src="../../../public/js/jquery.metisMenu.js"></script>
    <script src="../../../public/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../../../public/js/morris/morris.js"></script>
    <script src="../../../public/js/custom.js"></script>


</body>

</html>