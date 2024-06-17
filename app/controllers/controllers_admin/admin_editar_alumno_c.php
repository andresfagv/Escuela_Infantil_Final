<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_editar_alumno_m.php");
?>

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
        function confirmarEnvio() {
            return confirm("¿Estás seguro de que quieres editar este alumno?");
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
                        <img src="../../../public/img/administracion.png" class="user-image img-responsive" />
                    </li>

                    <li>
                        <a href="#"><img src="../../../public/img/salon-de-clases.png"> Clases<span class=" arrow"> <img src="../../../public/img/arrow.png"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../../controllers/controllers_admin/admin_listar_clase_c.php">Ver</a>
                            </li>
                            <li>
                                <a href="../../controllers/controllers_admin/admin_crear_clase_c.php">Crear</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_menu_c.php"><img src="../../../public/img/menu.png"> Menu</a>

                    </li>

                    <li>
                        <a href="#"><img src="../../../public/img/educador.png"> Educadores<span class=" arrow"> <img src="../../../public/img/arrow.png"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../../controllers/controllers_admin/admin_listar_educadores_c.php">Ver</a>
                            </li>
                            <li>
                                <a href="../../controllers/controllers_admin/admin_crear_educador_c.php">Crear</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><img src="../../../public/img/ninos.png"> Alumnos<span class=" arrow"> <img src="../../../public/img/arrow.png"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../../controllers/controllers_admin/admin_listar_alumnos_c.php">Ver</a>
                            </li>
                            <li>
                                <a href="../../controllers/controllers_admin/admin_crear_alumno_c.php">Crear</a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_contacto_c.php"><img src="../../../public/img/contactos.png"> Contactos</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_biblioteca_c.php"><img src="../../../public/img/biblioteca.png"> Biblioteca</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_galeria_c.php"><img src="../../../public/img/camara.png"> Galeria</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_documentos_c.php"><img src="../../../public/img/documentos.png"> Documentos</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_listar_autorizaciones_c.php"><img src="../../../public/img/contrato.png"> Autorizaciones</a>

                    </li>

                    <li>
                        <a href="../../controllers/controllers_admin/admin_crear_admin_c.php"><img src="../../../public/img/conf.png"> Crear Perfil Administrador</a>
                    </li>

                </ul>
            </div>
        </nav>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Editar Alumno</h2>
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
                                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id_estudiante=' . $id_estudiante); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmarEnvio();">
                                            <fieldset>
                                                <legend>Datos Alumno</legend>
                                                <div class="form-group">
                                                    <label>Nombre Alumno *</label>
                                                    <input class="form-control" id="nombre_alumno" name="nombre_alumno" placeholder="Nombre del Alumno" value="<?php echo htmlspecialchars($datos['nombre_estudiante']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido Alumno *</label>
                                                    <input class="form-control" id="apellido_alumno" name="apellido_alumno" placeholder="Apellido del Alumno" value="<?php echo htmlspecialchars($datos['apellido_estudiante']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento *</label>
                                                    <input class="form-control" type="date" id="f_nacimiento" name="f_nacimiento" value="<?php echo htmlspecialchars($datos['f_nacimiento']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_alumno" name="sexo_alumno" required>
                                                        <option value="hombre" <?php echo ($datos['sexo_estudiante'] == 'hombre') ? 'selected' : ''; ?>>Hombre</option>
                                                        <option value="mujer" <?php echo ($datos['sexo_estudiante'] == 'mujer') ? 'selected' : ''; ?>>Mujer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Foto Perfil</label>
                                                    <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" />
                                                    <p>Foto Actual:</p>
                                                    <?php if ($datos['img']) : ?>
                                                        <img src="../../../media/avatar/alumno/<?php echo htmlspecialchars($datos['img']); ?>" alt="Foto de Perfil" class="foto-perfil-datos"/>
                                                    <?php endif; ?>
                                                </div><br>
                                                <div class="form-group">
                                                    <label>Alergias</label>
                                                    <textarea class="form-control" id="alergias" name="alergias"><?php echo htmlspecialchars($datos['alergias']); ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Otros Datos de Interés</label>
                                                    <textarea class="form-control" id="comentarios" name="comentarios"><?php echo htmlspecialchars($datos['comentarios']); ?></textarea>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Curso</legend>
                                                <div class="form-group">
                                                    <select class="form-control" name="curso">
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
                                                    <input class="form-control" id="nombre_padre" name="nombre_padre" placeholder="Nombre del Padre" value="<?php echo htmlspecialchars($datos['nombre_padre']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido Padre *</label>
                                                    <input class="form-control" id="apellido_padre" name="apellido_padre" placeholder="Apellido del Padre" value="<?php echo htmlspecialchars($datos['apellido_padre']); ?>" required />
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
                                                    <input class="form-control" id="telefono" name="telefono" placeholder="Teléfono del Padre" value="<?php echo htmlspecialchars($datos['tel_padre']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Relación *</label>
                                                    <input class="form-control" id="relacion" name="relacion" placeholder="Relación con el Alumno" value="<?php echo htmlspecialchars($datos['relacion']); ?>" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_padre" name="sexo_padre" required>
                                                        <option value="hombre" <?php echo ($datos['sexo_padre'] == 'hombre') ? 'selected' : ''; ?>>Hombre</option>
                                                        <option value="mujer" <?php echo ($datos['sexo_padre'] == 'mujer') ? 'selected' : ''; ?>>Mujer</option>
                                                    </select>
                                                </div>
                                            </fieldset>

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
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
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

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_estudiante = isset($_GET['id_estudiante']) ? $_GET['id_estudiante'] : null;
    $datos = obtenerDatosEstudiante($id_estudiante);

    if (!$id_estudiante) {
        die("No se proporcionó el id del estudiante");
    }

    // Obtén los datos del formulario
    $nombre_alumno = test_input($_POST['nombre_alumno']);
    $apellido_alumno = test_input($_POST['apellido_alumno']);
    $f_nacimiento = test_input($_POST['f_nacimiento']);
    $sexo_alumno = test_input($_POST['sexo_alumno']);
    $alergias = test_input($_POST['alergias']);
    $comentarios = test_input($_POST['comentarios']);

    // Datos del padre
    $nombre_padre = test_input($_POST['nombre_padre']);
    $apellido_padre = test_input($_POST['apellido_padre']);
    $email = test_input($_POST['email']);
    $telefono = test_input($_POST['telefono']);
    $relacion = test_input($_POST['relacion']);
    $sexo_padre = test_input($_POST['sexo_padre']);
    $dni = test_input($_POST['dni']);
    $curso = test_input($_POST['curso']);

    $seguir = true;

    // Manejo de la subida de la foto
    if ($seguir) {
        $nombre_foto_extension = $datos['img']; // Si no hay nueva foto, usa la existente

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../../../media/avatar/alumno/";
            $nombre_foto = $nombre_alumno . "_" . $apellido_alumno;
            $extension = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));

            $target_file = $target_dir . $nombre_foto . "." . $extension;

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $nombre_foto_extension = $nombre_foto . "." . $extension;
                echo "La foto ha sido subida con éxito.";
            } else {
                echo "Lo siento, hubo un error al subir la foto.";
            }
        }

        $datos_padre_y_usuario = obtenerPadreYUsuarioPorIdEstudiante($id_estudiante);

        if ($datos_padre_y_usuario) {
            $id_padre = $datos_padre_y_usuario['id_padre'];
            $id_user = $datos_padre_y_usuario['id_user'];

            // Ahora puedes llamar a tus funciones de actualización con estos valores
            editarAlumno($id_estudiante, $nombre_alumno, $apellido_alumno, $f_nacimiento, $sexo_alumno, $alergias, $nombre_foto_extension, $comentarios);
            editarPadre($id_padre, $id_user, $nombre_padre, $apellido_padre, $email, $telefono, $relacion, $sexo_padre, $dni, $id_estudiante);
            editarInscribirEstudianteEnClase($curso, $id_estudiante);
        } else {
            echo "Error: No se encontró el padre para el id_estudiante proporcionado.";
        }

        echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_alumnos_c.php';</script>";
    }
}



?>