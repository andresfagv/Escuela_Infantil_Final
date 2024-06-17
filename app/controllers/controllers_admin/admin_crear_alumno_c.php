<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_crear_alumno_m.php");
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
            return confirm("¿Estás seguro de que quieres crear este alumno?");
        }

        function toggleTutor2() {
            var addTutor2 = document.getElementById("add_tutor2").value;
            var tutor2Fields = document.getElementById("tutor2_fields");
            if (addTutor2 === "si") {
                tutor2Fields.style.display = "block";
            } else {
                tutor2Fields.style.display = "none";
            }
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
                        <h2>Crear Alumno</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos Alumno
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmarEnvio();">
                                            <fieldset>
                                                <legend>Datos Alumno</legend>
                                                <div class="form-group">
                                                    <label>Nombre Alumno *</label>
                                                    <input class="form-control" id="nombre_alumno" name="nombre_alumno" placeholder="Nombre del Alumno" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido Alumno *</label>
                                                    <input class="form-control" id="apellido_alumno" name="apellido_alumno" placeholder="Apellido del Alumno" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento *</label>
                                                    <input class="form-control" type="date" id="f_nacimiento" name="f_nacimiento" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_alumno" name="sexo_alumno" required>
                                                        <option value="hombre">Hombre</option>
                                                        <option value="mujer">Mujer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Foto Perfil</label>
                                                    <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Alergias</label>
                                                    <textarea class="form-control" id="alergias" name="alergias"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Otros Datos de Interés</label>
                                                    <textarea class="form-control" id="comentarios" name="comentarios"></textarea>
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
                                                                echo '<option name="curso" value="' . $curso['id'] . '">' . $curso['nombre'] . '</option>';
                                                            }
                                                        } else {
                                                            echo '<option value="">No hay cursos disponibles</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </fieldset>


                                            <fieldset>
                                                <legend>Datos del Tutor 1</legend>
                                                <div class="form-group">
                                                    <label>Nombre *</label>
                                                    <input class="form-control" id="nombre_padre" name="nombre_padre" placeholder="Nombre del Padre" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido *</label>
                                                    <input class="form-control" id="apellido_padre" name="apellido_padre" placeholder="Apellido del Padre" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>DNI</label>
                                                    <input class="form-control" id="dni_padre" name="dni_padre" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input class="form-control" type="email" id="email_padre" name="email_padre" placeholder="Email del Padre" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono *</label>
                                                    <input class="form-control" id="telefono_padre" name="telefono_padre" placeholder="Teléfono del Padre" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Relación *</label>
                                                    <input class="form-control" id="relacion_padre" name="relacion_padre" placeholder="Relación con el Alumno" required />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_padre" name="sexo_padre" required>
                                                        <option value="hombre">Hombre</option>
                                                        <option value="mujer">Mujer</option>
                                                    </select>
                                                </div>
                                            </fieldset>
                                            <hr>
                                            <div class="form-group">
                                                <label>¿Desea añadir un segundo tutor? *</label>
                                                <select class="form-control" id="add_tutor2" name="add_tutor2" onchange="toggleTutor2()" required>
                                                    <option value="no">No</option>
                                                    <option value="si">Sí</option>
                                                </select>
                                            </div>

                                            <fieldset id="tutor2_fields" style="display: none;">
                                                <legend>Datos del Tutor 2 (Opcional)</legend>
                                                <div class="form-group">
                                                    <label>Nombre*</label>
                                                    <input class="form-control" id="nombre_madre" name="nombre_madre" placeholder="Nombre del Padre" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Apellido *</label>
                                                    <input class="form-control" id="apellido_madre" name="apellido_madre" placeholder="Apellido del Padre" />
                                                </div>
                                                <div class="form-group">
                                                    <label>DNI</label>
                                                    <input class="form-control" id="dni_madre" name="dni_madre" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Email *</label>
                                                    <input class="form-control" type="email" id="email_madre" name="email_madre" placeholder="Email del Padre" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Teléfono *</label>
                                                    <input class="form-control" id="telefono_madre" name="telefono_madre" placeholder="Teléfono del Padre" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Relación *</label>
                                                    <input class="form-control" id="relacion_madre" name="relacion_madre" placeholder="Relación con el Alumno" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Sexo *</label>
                                                    <select class="form-control" id="sexo_madre" name="sexo_madre">
                                                        <option value="hombre">Hombre</option>
                                                        <option value="mujer">Mujer</option>
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
    // Datos del alumno
    $nombre_alumno = test_input($_POST['nombre_alumno']);
    $apellido_alumno = test_input($_POST['apellido_alumno']);
    $f_nacimiento = test_input($_POST['f_nacimiento']);
    $sexo_alumno = test_input($_POST['sexo_alumno']);
    $alergias = test_input($_POST['alergias']);
    $comentarios = test_input($_POST['comentarios']);

    // Datos del tutor1 (padre)
    $nombre_padre = test_input($_POST['nombre_padre']);
    $apellido_padre = test_input($_POST['apellido_padre']);
    $email_padre = test_input($_POST['email_padre']);
    $telefono_padre = test_input($_POST['telefono_padre']);
    $relacion_padre = test_input($_POST['relacion_padre']);
    $sexo_padre = test_input($_POST['sexo_padre']);
    $dni_padre = test_input($_POST['dni_padre']);


    // Datos del tutor2 (madre))
    $add_tutor2 = test_input($_POST['add_tutor2']);
    $madre_completo = false;

    if ($add_tutor2 == "si") {
        $nombre_madre = test_input($_POST['nombre_madre']);
        $apellido_madre = test_input($_POST['apellido_madre']);
        $email_madre = test_input($_POST['email_madre']);
        $telefono_madre = test_input($_POST['telefono_madre']);
        $relacion_madre = test_input($_POST['relacion_madre']);
        $sexo_madre = test_input($_POST['sexo_madre']);
        $dni_madre = test_input($_POST['dni_madre']);
        $madre_completo = !empty($nombre_madre) && !empty($apellido_madre) && !empty($dni_madre) && !empty($email_madre) && !empty($telefono_madre) && !empty($relacion_madre);
    }







    $curso = test_input($_POST['curso']);


    $seguir = true;

    if (emailExists($email_padre)) {
        echo "El email del tutor 1 ya existe.";

        $seguir = false;
    }

    if ($madre_completo) {
        if (emailExists($email_madre)) {
            echo "El email del tutor 2 ya existe.";
            $seguir = false;
        }
    }

    if ($seguir) {
        $target_dir = "../../../media/avatar/alumno/"; // Carpeta de destino
        $nombre_foto = trim($nombre_alumno) . "_" . trim($apellido_alumno);
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
                echo '4';
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
        $password_padre = crearPassword($email_padre, $dni_padre);
        $id_user_padre = crearUser($password_padre, $email_padre);
        $id_alumno = crearAlumno($nombre_alumno, $apellido_alumno, $f_nacimiento, $sexo_alumno, $alergias, $nombre_foto_extension, $comentarios);
        crearPadre($id_user_padre, $nombre_padre, $apellido_padre, $email_padre, $telefono_padre, $relacion_padre, $sexo_padre, $dni_padre, $id_alumno);
        inscribirEstudianteEnClase($curso, $id_alumno);
    }

    if ($seguir && $madre_completo) {
        $password_madre = crearPassword($email_madre, $dni_madre);
        $id_user_madre = crearUser($password_madre, $email_madre);
        crearPadre($id_user_madre, $nombre_madre, $apellido_madre, $email_madre, $telefono_madre, $relacion_madre, $sexo_madre, $dni_madre, $id_alumno);
    }

    if ($seguir) {
        //echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_alumnos_c.php';</script>";
    }
}
?>