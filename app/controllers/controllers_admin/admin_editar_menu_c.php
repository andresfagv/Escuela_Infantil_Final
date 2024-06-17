<?php
require_once("../../controllers/controllers_admin/admin_checklog.php");
require_once("../../models/models_admin/admin_editar_menu_m.php");
$nombre_clase = obtenerNombreClase($idClase);
$menu = obtenerMenuPorClase($idClase);
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
            return confirm("¿Estás seguro de que quieres editar este menú?");
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
                        <h2>Editar Menu: <?php echo $nombre_clase; ?></h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Datos Menu Semanal
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . urlencode($idClase); ?>" method="post" enctype="multipart/form-data" onsubmit="return confirmarEnvio();">

                                            <?php if (!empty($menu)) : ?>
                                                <?php foreach ($menu as $index => $diaMenu) : ?>
                                                    <div class="form-group">
                                                        <label><?php echo $diaMenu['dia']; ?> Comida 1 </label>
                                                        <input class="form-control" name="comida1_<?php echo $index; ?>" value="<?php echo htmlspecialchars($diaMenu['comida1']); ?>" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label><?php echo $diaMenu['dia']; ?> Comida 2 </label>
                                                        <input class="form-control" name="comida2_<?php echo $index; ?>" value="<?php echo htmlspecialchars($diaMenu['comida2']); ?>" required />
                                                    </div>
                                                    <input type="hidden" name="dia_<?php echo $index; ?>" value="<?php echo $diaMenu['dia']; ?>">
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <p>No se encontró un menú para la clase especificada.</p>
                                            <?php endif; ?>

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
    $idClase = $_GET['id'];


    try {
        global $conn;
        $diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];

        for ($index = 0; $index < 5; $index++) {
            $dia = $diasSemana[$index];
            $comida1 = $_POST["comida1_" . $index];
            $comida2 = $_POST["comida2_" . $index];

            $stmt = $conn->prepare("UPDATE menusemanal SET comida1 = :comida1, comida2 = :comida2 WHERE (dia = :dia AND id_clase = :id_clase)");
            $stmt->bindParam(':comida1', $comida1);
            $stmt->bindParam(':comida2', $comida2);
            $stmt->bindParam(':dia', $dia);
            $stmt->bindParam(':id_clase', $idClase);
            $stmt->execute();
        }

        echo "Menú actualizado con éxito.";
    } catch (PDOException $e) {
        echo "Error al actualizar el menú: " . $e->getMessage();
    }
    $conn = null;
    echo "<script>window.location.href = '../../controllers/controllers_admin/admin_listar_menu_c.php';</script>";
}
?>