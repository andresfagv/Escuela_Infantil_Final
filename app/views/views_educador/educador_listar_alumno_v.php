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

    <script>

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
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alumnos</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <select id="select-clase" class="form-control">
                            <option value="">Seleccione una clase</option>
                            <?php foreach ($clases as $clase) : ?>
                                <option value="<?php echo $clase['id']; ?>">
                                    <?php echo htmlspecialchars($clase['nombre'] . ' -> ' . $clase['nivel']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div id="alumnos"></div>

                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
                <!-- /. ROW  -->
            </div>


            <script src="../../js/educador/educador_ajax_alumno.js"></script>

            <script src="../../../public/js/jquery-1.10.2.js"></script>
            <script src="../../../public/js/bootstrap.min.js"></script>
            <script src="../../../public/js/jquery.metisMenu.js"></script>
            <script src="../../../public/js/morris/raphael-2.1.0.min.js"></script>
            <script src="../../../public/js/morris/morris.js"></script>
            <script src="../../../public/js/custom.js"></script>


</body>

</html>