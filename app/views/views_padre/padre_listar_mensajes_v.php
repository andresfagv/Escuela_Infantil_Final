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
            <div id="page-inner">
                <!-- ROW -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>Ver Mensajes de <?php if(isset($_SESSION['nombre_padre'])){echo $_SESSION['nombre_padre'];} ?></h2>
                    </div>
                </div>
                <hr>
                <?php
                if ($arrayMensajesDePadre) {
                    foreach ($arrayMensajesDePadre as $key) {
                        echo '<div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">De:
                                            '.$key['nombre'].'
                                        </div>
                                        <div class="card-body">
                                            <h5 class="main-text ">'.$key['titulo'].'</h5>
                                            <p class="text-body-secondary">'.$key['contenido'].'</p>
                                        </div>
                                        <div class="card-footer text-body-secondary">
                                            '.substr($key['fecha_envio'], 0, 10);
                                            if($key['visto'] == 0) {
                                                echo '<img src="../../../public/img/check-regular-24.png" style="cursor:pointer" class="visto" data-valor="'.$key['id'].'">';
                                            }
                        echo          '</div>
                                    </div>
                                </div>
                            </div>
                            <hr>';
                    }
                }
                
                ?>
                <hr>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imgs = document.querySelectorAll('img.visto');
            imgs.forEach(function(img) {
                img.addEventListener('click', function() {
                    const idMensaje = img.getAttribute('data-valor');
                    console.log(idMensaje);

                    fetch('../../controllers/controllers_padre/padre_cambiar_EstadoMensjaje_c.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ idMensaje: idMensaje })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch((error) => {
                        console.log('Error:', error);
                    });

                });
            });
        });
    </script>
</body>

</html>
