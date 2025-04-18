<?php
    // SDK de Mercado Pago
    require __DIR__ .  '/logic/MP/vendor/autoload.php';

    // Agrega credenciales
    MercadoPago\SDK::setAccessToken('APP_USR-5487703189298422-120713-32a827617148ff18215a4835944fb907-257007062');

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'PAGO DIPLOMADO DE ESPECIALIZACION EN GESTION SANITARIA Y ENFERMEDADES DE TRUCHAS';
    $item->quantity = 1;
    $item->unit_price = $_GET['monto'];
    $preference->items = array($item);
    $preference->save();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Nabavet - Detalle de Pago</title>
    <meta name="description"
        content="DIPLOMADO DE ESPECIALIZACION EN GESTION SANITARIA Y ENFERMEDADES DE TRUCHAS - Inicio 19 de Enero 2021.">
    <meta name="keywords"
        content="nabavet, diplomados arequipa, arequipa, diplomados, veterinaria, pesca, acuicultura, programa nacional de innovacion en pesca y acuicultura.">

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="plugins/fontawesome/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="plugins/animate.css">
    <!-- Prettyphoto -->
    <link rel="stylesheet" href="plugins/prettyPhoto.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="plugins/owl/owl.carousel.css">
    <link rel="stylesheet" href="plugins/owl/owl.theme.css">
    <!-- Flexslider -->
    <link rel="stylesheet" href="plugins/flex-slider/flexslider.css">
    <!-- Slick-slider -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <!-- Style Swicther -->
    <link id="style-switch" href="css/presets/preset3.css" media="screen" rel="stylesheet" type="text/css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="plugins/html5shiv.js"></script>
      <script src="plugins/respond.min.js"></script>
    <![endif]-->

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--Favicon-->
    <link href="img/logotipos[1].ico" rel="shortcut icon" />

    <style>
        section.hero-slider .slider-item {
            height: auto;
        }

        #copyright {
            background: #0382aa;
        }

        .copyright.angle::before {
            background: #0382aa;
        }

        .footer .widget-title {
            color: #003b5d;
        }

        .call-to-action {
            background: #01385f;
        }

        .btn.btn-primary {
            border: 2px solid #00bdc7;
        }

        .header-solid {
            background: #fff;
        }

        .header-solid ul.navbar-nav>li:hover>a,
        .header-solid ul.navbar-nav>li.active>a {
            color: #003b5d;
        }

        .btn.btn-primary:hover {
            background: #003b5d !important;
            color: white !important;
        }

        .nav-link:hover,
        .dropdown-item:hover {
            color: #003b5d !important;
        }

        .call-to-action .btn.btn-primary.white:hover {
            background: #394c1b;
        }

        .navbar-brand.navbar-bg{
            width: 6%;
            padding: 0px;
        }
        .custom_buttom{
            background-color: #fff !important; 
            color: #01385f !important; 
            border-radius: unset !important; 
            border-color: #fff !important;
        }
        @media (max-width: 600px) {
            .el_logo {
                display: none;
            }
            .navbar-collapse{
                background-color: #0081a6;
                box-shadow: 0px 2px 2px #313131;
            }
            .el_slider{
                height: 100% !important;
            }
            .jumbo_1{
                font-size: 10px !important;
            }
            .jumbo_padre{
                margin-top: 0px !important;
            }
            .call-to-action .btn.btn-primary{
                margin-top: 0px !important;
                float: inherit !important;
            }
            .pill_element{
                font-size: 10px !important;
            }
            #table_inversion{
                font-size: 10px !important;
            }
            .footer-about-us{
                text-align: center;
            }
            .footer-facebook{
                text-align: center;
            }
            .widget-title{
                margin-bottom: 0.5rem !important;
                margin-top: 1rem !important;
            }
            #dia_evento{
                width: 80px !important;
            }
            .modal-dialog{
                max-width: 100% !important;
            }
        }
    </style>

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v8.0&appId=264862841394255&autoLogAppEvents=1"
        nonce="4Z561k8i"></script>

    <div class="body-inner">

        <!-- Header start -->
        <header id="header" class="w-100" role="banner" style="border: none; position: absolute; z-index: 1001;">
            <!--<a href="index.html" class="navbar-brand navbar-bg text-center pt-0 pb-0"><img class="img-fluid" style="width: 75px;" src="img/logotipos[1].png" alt="logo"></a>-->
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark text-center">
                    <button class="navbar-toggler ml-auto border-0 rounded-0 text-white" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="fa fa-bars"></span>
                    </button>

                    <div id="navigation" class="collapse navbar-collapse text-center mx-auto" style="/*margin-left: 6% !important;*/">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item dropdown ml-3 el_logo">
                                <a class="my-2" href="/" role="button">
                                    <img src="img/logotipos[1].png" class="w-50">
                                </a>
                            </li>
                            <li class="nav-item dropdown ml-3">
                                <a class="my-2 btn btn-primary ml-1 custom_buttom" style="font-weight: bold;" href="#" data-toggle="modal" data-target="#formulario_nosotros" role="button">
                                    Nosotros
                                </a>
                            </li>
                            <li class="nav-item dropdown ml-3">
                                <a style="font-weight: bold;" href="capacitaciones" class="my-2 btn btn-primary custom_buttom">
                                    Capacitaciones
                                </a>
                            </li>
                            <li class="nav-item dropdown ml-3">
                                <a style="font-weight: bold;" target="_blank" class="my-2 btn btn-primary a_brochure custom_buttom">
                                    Brochure
                                </a>
                            </li>
                            <li class="nav-item dropdown ml-3">
                                <a class="my-2 btn btn-primary custom_buttom" style="font-weight: bold;/*! font-weight: bold; */" href="#" data-toggle="modal" data-target="#formulario" role="button">
                                    Acceso
                                </a>
                            </li>
                            <li class="nav-item ml-3">
                                <a style="font-weight: bold;" href="contact" class="my-2 btn btn-primary custom_buttom">Contacto</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--/ Header end -->

        <div id="banner-area" style="height: 450px; background-image: url(img/N.11.jpg); background-size: cover; background-position: center;">
            <!--<img src="img/N.11.jpg" class="w-100" alt="" />-->
            <div class="parallax-overlay"></div>
            <!-- Subpage title start -->
            <div class="banner-title-content">
                <div class="text-center">
                    <h2>Detalle de Pago</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item text-white" aria-current="page">Detalle de Pago</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Subpage title end -->
        </div>
        <!-- Banner area end -->

        <!-- Main container start -->
        <section id="main-container">
            <div class="container">

                <div class="row">
                    <table class="table text-center">
                        <tr>
                            <td colspan="4">
                                <h4>Concepto</h4>
                                <p>PAGO DIPLOMADO DE ESPECIALIZACION EN GESTION SANITARIA Y ENFERMEDADES DE TRUCHAS</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Tipo de Estudiante</h4>
                                <p><?php echo $_GET['tipo_estudiante']; ?></p>
                            </td>
                            <td>
                                <h4>Precio</h4>
                                <p>S/ <?php echo $_GET['monto']; ?></p>
                            </td>
                            <td>
                                <h4>Numero de Cuotas</h4>
                                <p><?php echo $_GET['n_cuotas']; ?></p>
                            </td>
                            <td>
                                <h4>Debe</h4>
                                <p>S/ <?php echo $_GET['n_cuotas'] == 2?$_GET['monto']:"0.00"; ?></p>
                            </td>
                        </tr>
                    </table>
                    <script src="https://www.mercadopago.com.pe/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>">
                    </script>
                </div>
            </div>
            <!--/ container end -->
        </section>
        <!--/ Main container end -->

        <footer id="footer" class="footer"
            style="background: #fff url(../img/manual_logo_nabavet[1].png) no-repeat center 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 footer-widget footer-facebook">
                        <h3 class="widget-title">Siguenos en Facebook</h3>

                        <div class="fb-page" data-href="https://www.facebook.com/PreservacionAnimalyAmbiental"
                            data-tabs="" data-width="" data-height="" data-small-header="false"
                            data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/PreservacionAnimalyAmbiental"
                                class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com/PreservacionAnimalyAmbiental">Nabavet</a>
                            </blockquote>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 footer-widget footer-about-us">
                        <h3 class="widget-title">Sobre Nosotros</h3>
                        <!--<h4>Direccion</h4>
                        <p style="color: #3b4d25;">Av. Goyeneche 1811 - Miraflores</p>-->
                        <div class="row" style="color: #3b4d25;">
                            <div class="col-md-6">
                                <h4>Correo Electronico:</h4>
                                <p class="mb-0">info@nabavet.com</p>
                                <p>nabavetperu@gmail.com</p>
                            </div>
                            <div class="col-md-6">
                                <h4>Celular</h4>
                                <a href="https://wa.link/wb5k0f" target="_blank"><i class="fa fa-whatsapp"></i> +51 926 001 020</a>
                            </div>
                        </div>

                        <a href="#" class="btn btn-primary custom_buttom" data-toggle="modal" data-target="#formulario_docentes"
                            style="" id="btn_login_docente">Inicio
                            de Sesión Docentes</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright start -->
        <section id="copyright" class="copyright angle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-social unstyled">
                            <li>
                                <!--<a title="Twitter" href="#">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-twitter"></i></span>
                                </a>-->
                                <a title="Facebook" href="https://www.facebook.com/PreservacionAnimalyAmbiental">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-facebook"></i></span>
                                </a>
                                <!--<a title="Google+" href="#">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-google-plus"></i></span>
                                </a>-->
                                <a title="linkedin" href="#">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-linkedin"></i></span>
                                </a>
                                <!--<a title="Pinterest" href="#">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-pinterest"></i></span>
                                </a>-->
                                <a title="WhatsApp" href="https://wa.link/wb5k0f">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-whatsapp"></i></span>
                                </a>
                                <a title="Instagram" href="https://www.instagram.com/nabavetperu/">
                                    <span class="icon-pentagon wow bounceIn"><i class="fa fa-instagram"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ Row end -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="copyright-info">
                            &copy; Copyright 2020 Themefisher. <span>Designed by <a
                                    href="https://themefisher.com">Themefisher.com</a></span>
                        </div>
                    </div>
                </div>
                <!--/ Row end -->
                <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top affix position-fixed">
                    <button class="btn btn-primary" title="Back to Top"><i class="fa fa-angle-double-up"></i></button>
                </div>
            </div>
            <!--/ Container end -->
        </section>
        <!--/ Copyright end -->

    </div>


    <!----------------------------------------------------------------------->
    <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 95%;">
            <div class="modal-content" style="background-color: rgb(14, 16, 40,.9); height: auto;">
                <!--<div class="modal-header" style="position: relative; padding-top: 0; padding-bottom: 0;">
                    <h3 class="modal-title mb-4 text-center" >Inicio se Sesion Alumnos</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: #f4e25b;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>-->
                <div class="modal-body">
                    <iframe src="login/login_a.php" class="w-100" style="height: 520px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------------------->
    <!----------------------------------------------------------------------->
    <div class="modal fade" id="formulario_docentes" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel_docentes" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 95%;">
            <div class="modal-content" style="background-color: rgb(14, 16, 40,.9); height: auto;">
                <!--<div class="modal-header" style="position: relative; padding-top: 0; padding-bottom: 0;">
                    <h3 class="modal-title mb-4 text-center" >Inicio se Sesion Alumnos</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: #f4e25b;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>-->
                <div class="modal-body">
                    <iframe src="login/login_p.php" class="w-100" style="height: 520px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------------------->
    <!----------------------------------------------------------------------->
    <div class="modal fade" id="formulario_nosotros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 50%;">
            <div class="modal-content" style="background-color: rgb(14, 16, 40,.9); height: auto;">
                <div class="modal-header" style="position: relative; padding-top: 0; padding-bottom: 0;">
                    <h3 class="modal-title mb-4 text-center white">¿Quienes Somos?</h3>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="color: #f4e25b;">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="video_nosotros">
                </div>
            </div>
        </div>
    </div>
    <!----------------------------------------------------------------------->

    <!-- jQuery -->
    <script src="plugins/jQuery/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <!-- Style Switcher -->
    <script type="text/javascript" src="plugins/style-switcher.js"></script>
    <!-- Owl Carousel -->
    <script type="text/javascript" src="plugins/owl/owl.carousel.js"></script>
    <!-- PrettyPhoto -->
    <script type="text/javascript" src="plugins/jquery.prettyPhoto.js"></script>
    <!-- Bxslider -->
    <script type="text/javascript" src="plugins/flex-slider/jquery.flexslider.js"></script>
    <!-- Slick slider -->
    <script type="text/javascript" src="plugins/slick/slick.min.js"></script>
    <!-- Isotope -->
    <script type="text/javascript" src="plugins/isotope.js"></script>
    <script type="text/javascript" src="plugins/ini.isotope.js"></script>
    <!-- Wow Animation -->
    <script type="text/javascript" src="plugins/wow.min.js"></script>
    <!-- Eeasing -->
    <script type="text/javascript" src="plugins/jquery.easing.1.3.js"></script>
    <!-- Counter -->
    <script type="text/javascript" src="plugins/jquery.counterup.min.js"></script>
    <!-- Waypoints -->
    <script type="text/javascript" src="plugins/waypoints.min.js"></script>
    <!-- google map -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
    <script src="plugins/google-map/gmap.js"></script>

    <!-- Main Script -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function () {
            limpiar_formulario();
            get_videos();
            get_brochure();
        });
        function get_videos() {
            $.post("logic/servicios.php?parAccion=get_videos", function (response) {
                var obj = JSON.parse(response);

                //$("#a_brochure").attr("href", "web/"+obj.brochure);

                if (obj.nosotros == "" || obj.nosotros == null || obj.nosotros == undefined) {
                    $("#video_nosotros").append(`<video src="img/SPOT 1-4.mp4" class="w-100"controls>
                        <source src="movie.mp4" type="video/mp4">
                    </video>`);
                } else {
                    $("#video_nosotros").append(obj.nosotros);
                }
                $("#video_pagina").append(obj.pagina);
            });
        }
        function send_mail() {
            $("#btn_enviar_correo").text("Enviando Mensaje");
            $("#btn_enviar_correo").attr("disabled", true);
            $.post("logic/servicios.php?parAccion=enviar_correo", {
                name: $("#name").val(),
                email: $("#email").val(),
                subject: $("#subject").val(),
                message: $("#message").val(),
            }, function (response) {
                var obj = JSON.parse(response);

                if (obj.Result == "OK") {
                    $("#btn_enviar_correo").text("Mensaje Enviado Correctamente");
                    limpiar_formulario();
                } else {
                    $("#btn_enviar_correo").text("El Mensaje no se ha podido enviar");
                }
            })
        }
        function limpiar_formulario() {
            $("#name").val("");
            $("#email").val("");
            $("#subject").val("");
            $("#message").val("");
        }
        function get_brochure() {
            $.post("logic/servicios.php?parAccion=get_brochure", function (response) {
                var obj = JSON.parse(response);

                $(".a_brochure").attr("href", "web/" + obj.brochure);
            });
        }
    </script>
</body>

</html>