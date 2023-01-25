<?php
require('config.php');

$now = new \DateTime('now');
$month = $now->format('m');
$year = $now->format('Y');
$day = $now->format('j');

if ($_POST) {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];
    $ano = $_POST['ano'];
    $qdia = intval($dia);
}
else {
    $dia = 0;
    $mes = 0;
    $ano = 0;
    $qdia = intval($day)+intval($dia);
}

$qmes = intval($month)+intval($mes);
$qano = intval($year)+intval($ano);

$fecha = $qano."-".$qmes."-".$qdia;
$jd=gregoriantojd($qmes,$dia,$qano);
$dsem = jddayofweek($jd,0);
//echo $dsem;
$fiestas = array("2018-3-26", "2018-3-27", "2018-3-28", "2018-3-29", "2018-4-23", "2018-5-14", "2018-8-14", "2018-8-15", "2018-9-3", "2018-9-4", "2018-9-5", "2018-9-6", "2018-10-11", "2018-10-31", "2018-11-1", "2018-12-5", "2018-12-6", "2018-12-24", "2018-12-25", "2018-12-26", "2018-12-27", "2018-12-31");
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Reserva</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="assets/css/main.css" />
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->

        <script type="text/javascript">
            var vdia = "<?php echo $dia; ?>";
            var vmes = "<?php echo $mes; ?>";
            var vano = "<?php echo $ano; ?>";
        </script>
        <style type="text/css">
            .calendar-wrap {
                float: center;
                width: 31%;
                height=auto;
            }
            
            .calendar {
                text-align: center;
            }
            
            .calendar-head th {
                text-align: center;
            }
            
            .calendar-body td {
                text-align: center;
                cursor: pointer;
            }
            
            .cf:before,
            .cf:after {
                content: " ";
                display: table;
            }
            
            .cf:after {
                clear: both;
            }
            
            table#t01 {
                text-align: center;
                vertical-align: middle;
                border-collapse: separate;
                border-spacing: 5px 5px;
                height: auto;
            }
            
            table#t01 td {
                vertical-align: middle;
                color: white;
            }
        </style>
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
                            <li><a href="vip.html">Sala VIP</a></li>
                            <li class="break"><a href="reserva.html">Reservas</a></li>
                            <li><a href="galeria.html">Galería</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Main Wrapper -->
            <div id="main-wrapper">

                <div id="intro" class="container">
                    <div id="footer" class="container">

                        <header>
                            <h2>HORARIOS</h2>
                        </header>
                        <h3>De lunes a viernes:</h3>
                        <p>Tardes: 17:00 - 18:45 - 20:30</p>
                        <h3>Viernes, sábados, domingos y festivos:</h3>
                        <p>Mañanas: 10:00 - 11:45 - 13:30<br> Tardes: 16:00 - 17:45 - 19:30 - 21:15</p>
                        <h2><br></h2>

                    </div>
                    <div class="row">
                        <section class="4u 12u(mobile)">
                            <header>
                                <h2>Sala 1</h2>
                            </header>
                            <?
                            $array1 = array();
                            $result1 = mysqli_query($mysqli, "SELECT hora FROM `dbunker` WHERE fecha ='$fecha' AND sala = '1'" );  
                            while($row1 = $result1->fetch_array(MYSQLI_ASSOC)){
                                $array1[] = $row1["hora"];
                            }
                            if($dsem==0 || $dsem==5 || $dsem==6 || in_array($fecha, $fiestas)){
                               ?>
                                <table id="t01" style="width:100%">
                                    <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/ma.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        $horas = array("10:00", "11:45", "13:30", "16:00", "17:45", "19:30", "21:15");
                                        for ($i = 1; $i <= 3; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array1)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                    <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/tar.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        for ($i = 4; $i <= 7; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array1)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                </table>
                                <?
                            } else {
                                ?>
                                    <table id="t01" style="width:100%">
                                        <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/tar.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        $horas = array("17:00", "18:45", "20:30");
                                        for ($i = 1; $i <= 3; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array1)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                    </table>
                                    <?
                                }
                            ?>

                        </section>
                        <section class="4u 12u(mobile)">
                            <header>
                                <h2>Selector de fechas</h2>
                            </header>
                            
                            <!-- <div onclick="ejecutar()">Pulsa para crear un boton</div> -->
                            <div id="calendar" class="container cf"></div>

                            <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <input id="dia" type="hidden" name="dia" value="" />
                                <input id="mes" type="hidden" name="mes" value="" />
                                <input id="ano" type="hidden" name="ano" value="" />
                            </form>
                        </section>

                        <section class="4u 12u(mobile)">
                            <header>
                                <h2>Sala 2</h2>
                            </header>
                            <?
                            $array2 = array();
                            $result2 = mysqli_query($mysqli, "SELECT hora FROM `dbunker` WHERE fecha ='$fecha' AND sala = '2'" );  
                            while($row2 = $result2->fetch_array(MYSQLI_ASSOC)){
                                $array2[] = $row2["hora"];
                            }
                            if($dsem==0 || $dsem==5 || $dsem==6 || in_array($fecha, $fiestas)){
                               ?>
                                <table id="t01" style="width:100%">
                                    <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/ma.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        $horas = array("10:00", "11:45", "13:30", "16:00", "17:45", "19:30", "21:15");
                                        for ($i = 1; $i <= 3; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array2)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                    <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/tar.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        for ($i = 4; $i <= 7; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array2)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                </table>
                                <?
                            } else {
                                ?>
                                    <table id="t01" style="width:100%">
                                        <tr>
                                        <td colspan="3" style="background-color:#464646;"><img src="images/tar.png" height=auto width=100% /></td>
                                    </tr>
                                        <?
                                        $horas = array("17:00", "18:45", "20:30");
                                        for ($i = 1; $i <= 3; $i++) {
                                        ?>
                                            <tr>
                                            <td style="width:24%; background-color:#464646;"><? echo $horas[$i-1]; ?></td>
                                        <?
                                            if (in_array($i, $array2)) {
                                        ?>
                                                <td style="width:40%; background-color:#874445;"><img src="images/ocupado.png" height=auto width=100% /></td>
                                                <td style="width:39%; background-color:#464646;"></td>
                                        <?
                                            } else {
                                        ?>
                                                <td style="width:40%; background-color:#3f8a50;"><img src="images/libre.png" height=auto width=100% /></td>
                                                <td style="width:36%; background-color:#464646; cursor:pointer;"><img src="images/reser.png" height=auto width=100% /></td>
                                        <?
                                            }
                                        ?>
                                            </tr>
                                        <?
                                        }
                                        ?>
                                    </table>
                                    <?
                                }
                            ?>
                        </section>

                    </div>
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

        <script src="js/calendario.js"></script>

    </body>

    </html>