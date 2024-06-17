<?php
require_once("../../controllers/controllers_educador/educador_checklog.php");
require_once("../../models/models_admin/admin_editar_alumno_m.php");
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

                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">


        <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Datos Alumno</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos Personales
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form">
                                            <fieldset>
                                                <legend>Datos Alumno</legend>
                                                <div class="form-group">
                                                    <label>Nombre Alumno *</label>
                                                    <input class="form-control" id="nombre_alumno" name="nombre_alumno" placeholder="Nombre del Alumno" value="<?php echo htmlspecialchars($datos['nombre_estudiante']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido Alumno *</label>
                                                    <input class="form-control" id="apellido_alumno" name="apellido_alumno" placeholder="Apellido del Alumno" value="<?php echo htmlspecialchars($datos['apellido_estudiante']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento *</label>
                                                    <input class="form-control" type="date" id="f_nacimiento" name="f_nacimiento" value="<?php echo htmlspecialchars($datos['f_nacimiento']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_alumno" name="sexo_alumno" required readonly>
                                                        <option value="hombre" <?php echo ($datos['sexo_estudiante'] == 'hombre') ? 'selected' : ''; ?>>Hombre</option>
                                                        <option value="mujer" <?php echo ($datos['sexo_estudiante'] == 'mujer') ? 'selected' : ''; ?>>Mujer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Foto Perfil: </label><br>
                                                    <?php if ($datos['img']) : ?>
                                                        <img src="../../../media/avatar/alumno/<?php echo htmlspecialchars($datos['img']); ?>" alt="Foto de Perfil" class="foto-perfil-datos"/>
                                                    <?php endif; ?>
                                                </div><br>
                                                <div class="form-group">
                                                    <label>Alergias</label>
                                                    <textarea class="form-control" id="alergias" name="alergias" readonly><?php echo htmlspecialchars($datos['alergias']); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Otros Datos de Interés</label>
                                                    <textarea class="form-control" id="comentarios" name="comentarios" readonly><?php echo htmlspecialchars($datos['comentarios']); ?></textarea>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Curso</legend>
                                                <div class="form-group">
                                                    <select class="form-control" name="curso" readonly>
                                                        <?php
                                                        // Llamamos a la función para obtener los cursos
                                                        $cursos = ObtenerCursos();

                                                        // Verificamos si se obtuvieron cursos
                                                        if ($cursos) {
                                                            // Iteramos sobre los cursos y creamos las opciones
                                                            foreach ($cursos as $curso) {
                                                                echo '<option value="' . $curso['id'] . '" ' . ($curso['id'] == $datos['id_curso'] ? 'selected' : '') . '>' . $curso['nombre'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No hay cursos disponibles</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </fieldset>

                                            <fieldset>
                                                <legend>Datos del Padre</legend>
                                                <div class="form-group">
                                                    <label>Nombre Padre *</label>
                                                    <input class="form-control" id="nombre_padre" name="nombre_padre" placeholder="Nombre del Padre" value="<?php echo htmlspecialchars($datos['nombre_padre']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido Padre *</label>
                                                    <input class="form-control" id="apellido_padre" name="apellido_padre" placeholder="Apellido del Padre" value="<?php echo htmlspecialchars($datos['apellido_padre']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>DNI</label>
                                                    <input class="form-control" id="dni" name="dni" value="<?php echo htmlspecialchars($datos['DNI']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input class="form-control" type="email" id="email" name="email" placeholder="Email del Padre" value="<?php echo htmlspecialchars($datos['email_padre']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono *</label>
                                                    <input class="form-control" id="telefono" name="telefono" placeholder="Teléfono del Padre" value="<?php echo htmlspecialchars($datos['tel_padre']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Relación *</label>
                                                    <input class="form-control" id="relacion" name="relacion" placeholder="Relación con el Alumno" value="<?php echo htmlspecialchars($datos['relacion']); ?>" required readonly />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_padre" name="sexo_padre" required readonly>
                                                        <option value="hombre" <?php echo ($datos['sexo_padre'] == 'hombre') ? 'selected' : ''; ?>>Hombre</option>
                                                        <option value="mujer" <?php echo ($datos['sexo_padre'] == 'mujer') ? 'selected' : ''; ?>>Mujer</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Elements -->
                    </div>
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