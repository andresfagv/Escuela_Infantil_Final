<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
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
                        <h2>Añadir Educador</h2>
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
                                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmarEnvio();">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input class="form-control" id="nombre" name="nombre" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input class="form-control" id="apellido" name="apellido" required />
                                            </div>

                                            <div class="form-group">
                                                <label>DNI</label>
                                                <input class="form-control" id="dni" name="dni" required />
                                            </div>

                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input class="form-control" type="tel" id="tel" name="tel" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Fecha Nacimiento</label>
                                                <input class="form-control" type="date" id="f_nac" name="f_nac" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Foto Perfil / Avatar</label>
                                                <input type="file" id="foto" name="foto" accept=".jpg, .jpeg, .png" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sexo" value="hombre" />Hombre
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="sexo" value="mujer" checked />Mujer
                                                    </label>
                                                </div>
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

require_once("../../models/models_admin/admin_crear_educador_m.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = test_input($_POST['nombre']);
    $apellido = test_input($_POST['apellido']);
    $dni = test_input($_POST['dni']);
    $email = test_input($_POST['email']);
    $tel = test_input($_POST['tel']);
    $f_nac = test_input($_POST['f_nac']);
    $sexo = test_input($_POST['sexo']);

    $seguir = true;
    $mensaje = 'Usuario Creado';

    if (emailExists($email)) {
        $seguir = false;
        $mensaje = 'El email ya ha sido introducido';
    }

    if ($seguir) {
        $target_dir = "../../../media/avatar/educador/"; // Carpeta de destino
        $nombre_foto = trim($nombre) . "_" . trim($apellido);

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
            }
        } elseif ($extension == "png") {
            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file_png)) {
                echo "La foto ha sido subida con éxito.";
                $nombre_foto_extension = $nombre_foto . ".png";
            } else {
                echo "Lo siento, hubo un error al subir la foto.";
            }
        } else {
            echo "Formato de imagen no compatible. Solo se admiten archivos JPG o PNG.";
        }

        $password = crearPassword($email, $dni);
        crearUser($password, $email);
        crearEducador($nombre, $apellido, $dni, $email, $tel, $f_nac, $sexo, $nombre_foto_extension);
        echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_educadores_c.php';</script>";
    }
}
?>