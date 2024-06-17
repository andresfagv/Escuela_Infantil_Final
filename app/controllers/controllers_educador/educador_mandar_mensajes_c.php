<?php
session_start();
require_once("../../models/models_padre/padre_mandar_mensajes_m.php");

// Definir variable para el mensaje de error
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = test_input($_POST['titulo']);
    $contenido = test_input($_POST['contenido']);
    $tipoDestino = $_POST['tipo_destino'];

    if ($tipoDestino == 'clases') {
        $claseId = $_POST['clase'];
        $mensaje = enviarMensajeAClase($claseId, $titulo, $contenido, $_SESSION['id_educador']);
    } elseif ($tipoDestino == 'padres') {
        $padreId = $_POST['padre'];
        if ($padreId == 'all') {
            $padres = getAllPadres();
            foreach ($padres as $padre) {
                enviarMensaje($padre['id'], $titulo, $contenido, $_SESSION['id_educador']);
            }
        } else {
            // Enviar mensaje a un solo padre
            enviarMensaje($padreId, $titulo, $contenido, $_SESSION['id_educador']);
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Educador</title>
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

    <script>
        function confirmarEnvio() {
            return confirm("¿Estás seguro de que quieres crear este usuario?");
        }
    </script>
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
                <!-- ROW -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Mandar Mensajes a Familias</h2>
                    </div>
                </div>


                <!-- ROW -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos Mensajes
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmarEnvio();">
                                            <div class="form-group">
                                                <label for="titulo">Titulo</label>
                                                <input class="form-control" id="titulo" name="titulo" placeholder="Titulo" required />
                                            </div>
                                            <div class="form-group">
                                                <label for="contenido">Contenido</label>
                                                <textarea class="form-control" id="contenido" name="contenido" placeholder="Este es el conenido del mensaje" required></textarea>
                                            </div>

                                            <!-- SELECCIONAR ENTRE MANDAR A CLASES O A PADRES  -->
                                            <div class="form-group">
                                                <label>Enviar a</label>
                                                <select class="form-control" id="tipo_destino" name="tipo_destino" onchange="mostrarDesplegable()">
                                                    <option value="" disabled selected>Seleccione destino</option>
                                                    <option value="clases">Clases</option>
                                                    <option value="padres">Padres</option>
                                                </select>
                                            </div>

                                            <!-- CLASES -->
                                            <div class="form-group" id="grupo_clases" style="display: none;">
                                                <label>Tus Clases</label>
                                                <select class="form-control" name="clase">
                                                    <option value="" disabled selected>Seleccione una clase</option>

                                                    <?php
                                                    // Llamamos a la función para obtener las clases
                                                    $clases = getAllClases();
                                                    // Verificamos si se obtuvieron clases
                                                    if ($clases) {
                                                        foreach ($clases as $clase) {
                                                            echo "<option value='" . $clase['id'] . "'>" . $clase['nombre'] . "->" . $clase['nivel'] . "</option>";
                                                        }
                                                    } else {
                                                        echo '<option value="">No hay clases disponibles</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <!-- PADRES -->
                                            <div class="form-group" id="grupo_padres" style="display: none;">
                                                <label>Padres</label>
                                                <select class="form-control" name="padre">
                                                    <option value="" disabled selected>Padre:/Nombre/Email ,Hijo:/Nombre/Apellido </option>
                                                    <option value="all">Todos los padres</option>
                                                    <?php
                                                    // Llamamos a la función para obtener los padres
                                                    $padres = obtenerTodosLosPadres();
                                                    // Verificamos si se obtuvieron padres
                                                    if ($padres) {
                                                        foreach ($padres as $padre) {
                                                            //echo "<img id='imgEstu'  src='../../../media/avatar/alumno/" . htmlspecialchars($padre['imgEstu'], ENT_QUOTES, 'UTF-8') . "'/>";

                                                            echo "<option value='" . $padre['idEstu'] . "'>Padres: " . $padre['nomPad'] . " (" . $padre['emailPad'] . ")  ------  Hijo:" . $padre['nomEstu'] . " " . $padre['apeEstu'] . "  </option>";                                                        }
                                                    } else {
                                                        echo '<option value="">No hay padres disponibles</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-default">Enviar</button>
                                            <button type="reset" class="btn btn-primary">Borrar Datos</button>

                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Elements -->
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <p><?php if(isset($mensaje)){echo $mensaje;} ;?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../../../public/js/jquery-1.10.2.js"></script>
    <script src="../../../public/js/bootstrap.min.js"></script>
    <script src="../../../public/js/jquery.metisMenu.js"></script>
    <script src="../../../public/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../../../public/js/morris/morris.js"></script>
    <script src="../../../public/js/custom.js"></script>
    <script>
        function mostrarDesplegable() {
            var tipoDestino = document.getElementById('tipo_destino').value;
            if (tipoDestino == 'clases') {
                document.getElementById('grupo_clases').style.display = 'block';
                document.getElementById('grupo_padres').style.display = 'none';
            } else if (tipoDestino == 'padres') {
                document.getElementById('grupo_clases').style.display = 'none';
                document.getElementById('grupo_padres').style.display = 'block';
            } else {
                document.getElementById('grupo_clases').style.display = 'none';
                document.getElementById('grupo_padres').style.display = 'none';
            }
        }
    </script>


</body>

</html>
