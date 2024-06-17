<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_educador/educador_listar_menu_m.php");
$clases = obtenerClases();
$menu = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $claseSeleccionada = $_POST['clase'];
    $menu = obtenerMenu($claseSeleccionada);
    $_SESSION['nombre_clase'] = array_column($clases, 'nombre', 'id')[$claseSeleccionada] ?? 'Clase Desconocida';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Educador</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
                <a class="navbar-brand" href="../../controllers/controllers_educador/educador_page_c.php">Panel Educador</a>
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
                        <img class='img-perfil' src="../../../media/avatar/educador/<?php echo htmlspecialchars($_SESSION['img'], ENT_QUOTES, 'UTF-8'); ?>" class="user-image img-responsive" />
                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_alumno_c.php"><img src="../../../public/img/ninos.png"> Alumnos</a>
                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_contactos_c.php"><img src="../../../public/img/contactos.png"> Contactos</a>
                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_menu_c.php"><img src="../../../public/img/menu.png"> Menú</a>
                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_galeria_c.php"><img src="../../../public/img/camara.png"> Galeria</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_biblioteca_c.php"><img src="../../../public/img/biblioteca.png"> Biblioteca</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_autorizaciones_c.php"><img src="../../../public/img/contrato.png"> Autorizaciones</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_educador/educador_listar_documentos_c.php"><img src="../../../public/img/documentos.png"> Documentos</a>

                    </li>

                    <li>
                        <a href="#"><img src="../../../public/img/comunicados.png"> Mensajes<span class=" arrow"> <img src="../../../public/img/arrow.png"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../../controllers/controllers_educador/educador_mandar_mensajes_c.php">Mandar</a>
                            </li>
                            <li>
                                <a href="../../controllers/controllers_educador/educador_listar_mensajes_c.php">Ver</a>
                            </li>
                        </ul>

                    </li>

                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">


            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Menú por Clases</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <div class="form-group">
                                <select id="select-clase" name="clase" class="form-control">
                                    <option value="">Seleccione una clase</option>
                                    <?php foreach ($clases as $clase) : ?>
                                        <option value="<?php echo $clase['id']; ?>">
                                            <?php echo htmlspecialchars($clase['nombre'] . ' -> ' . $clase['nivel']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>

                    <?php 
                    if ($menu) {
                        echo '<br><br>';
                        echo '<div class="panel panel-default">';
                        echo '    <div class="panel-heading">';
                        echo '        Menu Semanal Clase ' . htmlspecialchars($_SESSION['nombre_clase'], ENT_QUOTES, 'UTF-8');
                        echo '    </div>';
                        echo '    <div class="panel-body">';
                        echo '        <div class="table-responsive">';
                        echo '            <table class="table table-hover">';
                        echo '                <thead>';
                        echo '                    <tr>';
                        echo '                        <th>Día</th>';
                        echo '                        <th>Comida 1</th>';
                        echo '                        <th>Comida 2</th>';
                        echo '                    </tr>';
                        echo '                </thead>';
                        echo '                <tbody>';
                        foreach ($menu as $dia) {
                            echo '                    <tr>';
                            echo '                        <td>' . htmlspecialchars($dia["dia"], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '                        <td>' . htmlspecialchars($dia["comida1"], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '                        <td>' . htmlspecialchars($dia["comida2"], ENT_QUOTES, 'UTF-8') . '</td>';
                            echo '                    </tr>';
                        }
                        echo '                </tbody>';
                        echo '            </table>';
                        echo '        </div>';
                        echo '    </div>';
                        echo '</div>';
                    }
                    ?>

                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
                <!-- /. ROW  -->
            </div>


            <script src="../../../public/js/jquery-1.10.2.js"></script>
            <script src="../../../public/js/bootstrap.min.js"></script>
            <script src="../../../public/js/jquery.metisMenu.js"></script>
            <script src="../../../public/js/morris/raphael-2.1.0.min.js"></script>
            <script src="../../../public/js/morris/morris.js"></script>
            <script src="../../../public/js/custom.js"></script>


</body>

</html>


