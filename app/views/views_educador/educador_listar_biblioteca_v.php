<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Control Admin</title>
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
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que quieres devolver este articulo?");
        }

        function mostrarFormulario(id) {
            var form = document.getElementById("formularioContacto");
            var id_articulo = document.getElementById("id_articulo");
            id_articulo.value = id; // Asigna el valor del artículo seleccionado al campo oculto
            form.style.display = "block";
            console.log(id_articulo.value);
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
                <a class="navbar-brand" href="../../views/views_admin/admin_page_v.php">Panel Control</a>
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Biblioteca</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div id="formularioContacto" style="display:none;">
                        <h2>Alquilar Artículo</h2>
                        <form method="POST" action="../../controllers/controllers_educador/educador_listar_biblioteca_c.php?action=alquilar" enctype="multipart/form-data">
                            <input type="hidden" name="id_articulo" value="" id="id_articulo">
                            <select name='id_alumno' id="id_alumno" class="form-control" required>
                                <option value="">Seleccione un alumno</option>
                                <?php foreach ($alumnos as $alumno) : ?>
                                    <option value="<?php echo $alumno['id']; ?>">
                                        <?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <button type="submit" class="btn btn-default">Enviar</button>
                        </form>
                    </div>
                    <br><br><br><br>


                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Articulos Biblioteca Disponible
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Disponible</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($productos_disponible) : ?>
                                            <?php foreach ($productos_disponible as $producto) : ?>
                                                <tr>
                                                    <td><?= $producto['tipo'] ?></td>
                                                    <td><?= $producto['nombre'] ?></td>
                                                    <td><?= $producto['descripcion'] ?></td>
                                                    <td><?= $producto['disponible'] ? 'Disponible' : 'No disponible' ?></td>
                                                    <td class='btn-alquilar' onclick="mostrarFormulario(<?= $producto['id'] ?>)">Alquilar</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5">No hay artículos disponibles.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Articulos Biblioteca No Disponible
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Estudiante</th>
                                            <th>Disponible</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($productos_no_disponible) : ?>
                                            <?php foreach ($productos_no_disponible as $producto) : ?>
                                                <tr>
                                                    <td><?= $producto['tipo'] ?></td>
                                                    <td><?= $producto['nombre'] ?></td>
                                                    <td><?= getNombreAlumno($producto['id_alumno']) ?></td>
                                                    <td><?= $producto['disponible'] ? 'Disponible' : 'No disponible' ?></td>
                                                    <td class='btn-devolver'><a id='a-devolver' href="../../controllers/controllers_educador/educador_listar_biblioteca_c.php?action=devolver&id=<?= $producto['id'] ?>" onclick="return confirmarEliminacion();">Devolver</a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="10">No hay articulos por devolver</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
</body>

</html>