<!DOCTYPE HTML>
<!--
	Wide Angle by Pixelarity
	pixelarity.com | hello@pixelarity.com
	License: pixelarity.com/license
-->
<html>

<head>
    <title>Avisos Legales</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>

<body class="no-sidebar">
    <div id="page-wrapper">

        <!-- Header Wrapper -->
        <div id="header-wrapper">

            <!-- Header -->
            <div id="header" class="container">

                <?//*** Menu superior ***
				include("menu-superior.php");
				//***********************?>

            </div>

        </div>

        <!-- Main Wrapper -->
        <div id="main-wrapper">

            <!-- Wide Content -->
            <section id="content" class="container">
                <header>
                    <h2>PROTECCION DE DATOS DE CARACTER PERSONAL</h2>
                </header>
                
				<h3>Responsable del tratamiento de datos</h3>

				<p>
					<strong>Raz&oacute;n Social:</strong>BUNKER OCIO Y ENTRETENIMIENTO, S.L.<br>
					<strong>C.I.F:</strong> B47764816<br>
					<strong>Domicilio Social:</strong> C/ Esquila, 19 Bajo<br>
					<strong>Tel&eacute;fono:</strong> Tlf. 983 10 38 08<br>
					<strong>Email:</strong> info@bunkervalladolid.es<br>			
					<strong>Inscripci&oacute;n en el Registro Mercantil:</strong> Inscripción en el Registro Mercantil de Valladolid con fecha 15/03/2017, en el tomo 1517, folio 55, inscripción 1ª con hoja VA-28910.
				</p>


				<h3>Denegación y retirada del acceso a la Web y/o a los servicios</h3>

				<p>BUNKER OCIO Y ENTRETENIMIENTO, S.L. , se reserva el derecho a denegar o a retirar el acceso a su página Web, en cualquier momento y sin necesidad de preaviso, a aquellos usuarios que 
				incumplan las Condiciones Generales o las particulares que resulten de aplicación.</p>


				<h3>Legislación aplicable</h3>

				<p>Las Condiciones Generales se rigen por la legislación española.</p>



				<h3>Información legal a la recogida de datos</h3>

				<p>El Usuario garantiza la autenticidad y veracidad de todos aquellos datos que comunique tanto en la cumplimentación de los 
				formularios de petición de información y solicitud de presupuestos, realización de compras y reservas, etc.,  
				como en cualquier otro momento posterior, siendo de su responsabilidad el actualizar la información suministrada,
				de tal forma que refleje su situación real. El usuario será responsable de la inexactitud o falta de veracidad de 
				la información aportada.</p>

				<p>El usuario mediante la cumplimentación de los distintos formularios de recogida de datos de esta Web, 
				otorga su consentimiento expreso para el tratamiento de sus datos personales por BUNKER OCIO Y ENTRETENIMIENTO, S.L. 
				y su incorporación en un fichero debidamente registrado en la Agencia Española de Protección de Datos. (www.agpd.es) 
				del que es responsable la citada empresa, con la finalidad de  facilitar una mayor información de la empresa, 
				informar sobre productos, otorgar acceso a areas privadas, para clientes, venta de productos a través de la web.</p>

				<p>BUNKER OCIO Y ENTRETENIMIENTO, S.L.. ha adoptado las medidas técnicas y organizativas necesarias, para proteger los Datos de 
				Carácter Personal que recoge y son objeto de tratamiento automatizado.</p>

				<p>BUNKER OCIO Y ENTRETENIMIENTO, S.L.. se compromete, en todo caso, al tratamiento de los datos personales de acuerdo 
				con la Ley y normativa vigente en materia de protección de datos, así como a establecer los pertinentes compromisos de 
				confidencialidad con terceros a los que ceda o permita el acceso a estos datos personales.</p>

				<p>El usuario queda informado, de acuerdo con el artículo 5 de la ley 15/1999, de la posibilidad de 
				ejercer su derecho de acceso, rectificación, cancelación u oposición enviando una carta firmada junto 
				con fotocopia del DNI del titular de los datos,  dirigida a la empresa BUNKER OCIO Y ENTRETENIMIENTO, S.L.
				con el encabezamiento PROTECCIÓN DE DATOS al domicilio: Calle Esquila 19 Bajo, 47012, VALLADOLID; 
				Teléfono: 983103808 o bien mediante correo electrónico  a la dirección: info@bunkervalladolid.es</p>


            </section>

        </div>

        <!-- Footer Wrapper -->
        <div id="footer-wrapper">

            <?//*** Menu superior ***
				include("footer.php");
				//***********************?>

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

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(document).ready(function(){
        $.datepicker.setDefaults({
            dateFormat: 'dd-mm-yy',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            minDate: 0,
            firstDay: 1
        });
        $(".calendario").datepicker();
    });
    </script>

</body>

</html>