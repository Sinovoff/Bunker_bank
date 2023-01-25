<?require_once("init.php");?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Galería - Bunker Escape Room</title>
	<meta name="description" content="Fotograf&iacute;as de la sala de alquiler y del escape room Bunker Valladolid">
	<meta name="keywords" content="Bunker juego escape room Valladolid sala alquiler reuniones">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="css/jquery.fancybox.min.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>

<body class="no-sidebar">
    <div id="page-wrapper">

        <!-- Header Wrapper -->
        <div id="header-wrapper">

			<!-- Header -->
			<div id="header" class="container">

				<?//*** Menu superior ***
				include("menu-superior-galeria.php");
				//***********************?>
				<!-- Logo
				<h1 id="logo"><a href="index.html"><img src="images/logo.png" alt="" width="100%"></a></h1>

				
				<nav id="nav">
					<ul>
						<li><a href="inicio.html">Inicio</a></li>
						<li><a href="sala-eventos.php">Sala Eventos</a></li>
						<li class="break"><a href="">Reservas</a></li>
						<li><a href="galeria.php">Galería</a></li>
					</ul>
				</nav>
				-->
			</div>	

		</div>
        
        <div id="main-wrapper">
			<div id="intro" class="container">
                <header>
                    <h2>GALERÍA DE FOTOS</h2>
                </header>

				<?$opciones=array( 'order' =>"destacado DESC, orden");
				$aGalerias = Galeria::find("all",$opciones);
				if(count($aGalerias)>0){?>
					<div class="row">
						<?foreach($aGalerias as $galeria){?>
							<section class="4u 12u(mobile)">
								<a href="galeria/<?echo $galeria->imagen?>" data-fancybox="gallery" class="image image-full"><img src="galeria/l<?echo $galeria->imagen?>" alt="<?echo utf8_encode(stripslashes($galeria->titulo))?>"></a>
								<?echo utf8_encode(stripslashes($galeria->titulo))?>
							</section>
						<?}?>
					</div>
				<?}?>
			</div>
		</div>

        <!-- Footer Wrapper -->
        <div id="footer-wrapper">
			<?//****** footer ********
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
    <script src="js/jquery.fancybox.min.js"></script>

</body>

</html>