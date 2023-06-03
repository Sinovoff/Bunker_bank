<?php
                    $email = $_POST["email"];
                    $nombre = $_POST["name1"];
                
                
                    $s       = '=?UTF-8?B?'.base64_encode($nombre.' - ').'?=';
                    $r       = '=?UTF-8?B?'.base64_encode('Bunker').'?=';
                    $subject = '=?UTF-8?B?'.base64_encode('De '.$nombre.' para Bunker').'?=';

                    $s      .= $email;
                    $r      .= ' <info@bunkervalladolid.es>';

                    $header  = 'MIME-Version: 1.0' . "\r\n";
                    $header .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $header .= 'To: ' . $r. "\r\n";
                    $header .= 'From: ' . $s. "\r\n";

                    $msg     = '<html><head><title>Bono promoción</title></head>';
                    $msg    .= '<body>
                    <h1>Datos del solicitante del Bono Promoción:</h1> 
                    <p>Nombre: '.$nombre. '</p>
                    <p>Correo: '.$email. '</p>
                    </body></html>';

                    if(mail($r, $subject, $msg, $header)){
                        ?>
    <!DOCTYPE HTML>
    <!--
	Wide Angle by Pixelarity
	pixelarity.com | hello@pixelarity.com
	License: pixelarity.com/license
-->
    <html>

    <head>
        <title>Bono-Promo</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    </head>

    <body class="no-sidebar">
        <div id="page-wrapper">

            <!-- Header Wrapper -->
            <div id="header-wrapper">

                <!-- Header -->
                <div id="header" class="container">

                    <!-- Logo -->
                    <h1 id="logo">
                        <a href="index.html"><img src="images/logo.png" alt="" width="100%"></a>
                    </h1>

                    <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li><a href="inicio.html">Inicio</a></li>
                            <li><a href="vip.html">Sala de Eventos</a></li>
                            <li class="break"><a href="reserva.html">Reservas</a></li>
                            <li><a href="galeria.html">Galería</a></li>
                        </ul>
                    </nav>

                </div>

            </div>

            <!-- Main Wrapper -->
            <div id="footer2-wrapper">

                <!-- Footer -->
                <div id="footer" class="container">
                    <p><br></p>
                    <p><br></p>
                    <p><br></p>

                    <p>El correo se ha enviado correctamente.</p>

                    <div class="actions">
                        <a href="bono.html" class="button button-big button-alt">Volver</a>
                    </div>
                    <br>
                </div>
            </div>

            <!-- Footer Wrapper -->
            <div id="footer-wrapper">

                <!-- Footer -->
                <div id="footer" class="container">
                    <p>Para cualquier duda ponte en contacto con nosotros.</p>
                    <header>
                        <h2>Escape Room "The Bunker"</h2>
                    </header>
                    <p>C/ Esquila, 19 - 47012 Valladolid - <a href="mailto:info@bunkervalladolid.es">info@bunkervalladolid.es</a></p>
                    <ul class="contact">
                        <li><a href="https://www.instagram.com/bunkerescape/?hl=es" target="_blank" class="icon fa-instagram"><span>Instagram</span></a></li>
                        <li><a href="https://www.facebook.com/bunkervalladolid/" target="_blank" class="icon fa-facebook"><span>Facebook</span></a></li>
                        <li><a href="https://twitter.com/BUNKERVALLADOLI" target="_blank" class="icon fa-twitter"><span>Twitter</span></a></li>
                    </ul>
                </div>

                <!-- Copyright -->
                <div id="copyright" class="container">
                    &copy; The Bunker. All rights reserved.
                </div>

            </div>

        </div>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.dropotron.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/skel-viewport.min.js"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>

    </body>

    </html>

    <?
                    } else {
                        ?>
        <!DOCTYPE HTML>
        <!--
	Wide Angle by Pixelarity
	pixelarity.com | hello@pixelarity.com
	License: pixelarity.com/license
-->
        <html>

        <head>
            <title>Bono-Promo</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
            <link rel="stylesheet" href="assets/css/main.css" />
            <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        </head>

        <body class="no-sidebar">
            <div id="page-wrapper">

                <!-- Header Wrapper -->
                <div id="header-wrapper">

                    <!-- Header -->
                    <div id="header" class="container">

                        <!-- Logo -->
                        <h1 id="logo">
                            <a href="index.html"><img src="images/logo.png" alt="" width="100%"></a>
                        </h1>

                        <!-- Nav -->
                        <nav id="nav">
                            <ul>
                                <li><a href="inicio.html">Inicio</a></li>
                                <li><a href="vip.html">Sala de Eventos</a></li>
                                <li class="break"><a href="reserva.html">Reservas</a></li>
                                <li><a href="galeria.html">Galería</a></li>
                            </ul>
                        </nav>

                    </div>

                </div>

                <!-- Main Wrapper -->
                <div id="footer2-wrapper">

                    <!-- Footer -->
                    <div id="footer" class="container">
                        <p><br></p>
                        <p><br></p>
                        <p><br></p>
                        
                        <p>El correo no se ha podido enviar.</p>


                        <div class="actions">
                            <a href="bono.html" class="button button-big button-alt">Volver</a>
                        </div>
                        <br>
                    </div>
                </div>

                <!-- Footer Wrapper -->
                <div id="footer-wrapper">

                    <!-- Footer -->
                    <div id="footer" class="container">
                        <p>Para cualquier duda ponte en contacto con nosotros.</p>
                        <header>
                            <h2>Escape Room "The Bunker"</h2>
                        </header>
                        <p>C/ Esquila, 19 - 47012 Valladolid - <a href="mailto:info@bunkervalladolid.es">info@bunkervalladolid.es</a></p>
                        <ul class="contact">
                            <li><a href="https://www.instagram.com/bunkerescape/?hl=es" target="_blank" class="icon fa-instagram"><span>Instagram</span></a></li>
                            <li><a href="https://www.facebook.com/bunkervalladolid/" target="_blank" class="icon fa-facebook"><span>Facebook</span></a></li>
                            <li><a href="https://twitter.com/BUNKERVALLADOLI" target="_blank" class="icon fa-twitter"><span>Twitter</span></a></li>
                        </ul>
                    </div>

                    <!-- Copyright -->
                    <div id="copyright" class="container">
                        &copy; The Bunker. All rights reserved.
                    </div>

                </div>

            </div>

            <!-- Scripts -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/jquery.dropotron.min.js"></script>
            <script src="assets/js/skel.min.js"></script>
            <script src="assets/js/skel-viewport.min.js"></script>
            <script src="assets/js/util.js"></script>
            <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
            <script src="assets/js/main.js"></script>

        </body>

        </html>
        <?
                    }
                ?>