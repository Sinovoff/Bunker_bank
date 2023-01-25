<!DOCTYPE HTML>
<html>

<head>
	<title>Reservas- Bunker Escape Room</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="Bunker juego escape room niños Valladolid sala alquiler roombate competicion hall escape cumpleaños despedidas celebraciones empresas">
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/css/main.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.structure.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css" />
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158811797-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-158811797-1');
	</script>
</head>

<body class="no-sidebar">
	<div id="page-wrapper">

		<div id="header-wrapper">

			<div id="header" class="container">
				<?//*** Menu superior ***
				include("menu-superior-reservas.php");
				//***********************?>
			</div>

		</div>

		<div id="main-wrapper">

			<div id="intro" class="container">
				<div id="footer" class="container">
					<header>
						<h2>HORARIOS</h2>
					</header>
					<h3>De lunes a viernes:</h3>
					<p>Tardes: 17:00 - 18:45 - 20:30</p>
					<h3>Sábados, domingos y festivos:</h3>
					<p>Mañanas: 10:00 - 11:30 - 13:15<br> Tardes: 16:00 - 17:45 - 19:30 - 21:15</p>
					<p style="color:#ffff00">Compite con tus amigos reservando las 2 salas (máximo 10 personas)</p>
					<p style="color:#ffff00">Los menores de 16 años deberán ir siempre acompañados por un adulto o un monitor (preguntar)</p>
					<h2><br></h2>
				</div>
				
				<div class="row">
					
					<section class="4u 12u(mobile)">
						<header>
							<h2>Sala 1</h2>
							<p>(Máximo 6 personas)</p>
						</header>
						<div class="calendario1"></div>
					</section>

					<section class="4u 12u(mobile)">
						<header>
							<h2 id="horassala">Horarios Sala 1 <br><?echo date("d-m-Y")?></h2>
						</header>
						<?$diasemananumero=date("w") ;

						if($diasemananumero==0)			$diasemana="D";
						else if($diasemananumero==1)	$diasemana="L";
						else if($diasemananumero==2)	$diasemana="M";
						else if($diasemananumero==3)	$diasemana="X";
						else if($diasemananumero==4)	$diasemana="J";
						else if($diasemananumero==5)	$diasemana="V";
						else if($diasemananumero==6)	$diasemana="S";?>
			
						<ul class="fechaslibres">
							<?$opciones=array('conditions'=>"sala_id='1'",  'order' =>"hora");
							$aSalashoras = Salashora::find("all",$opciones);
							if(count($aSalashoras)>0){
								foreach($aSalashoras as $salahora){
									$aDiassemana=explode("-",$salahora->diasemana);
									if (in_array($diasemana, $aDiassemana)){
										$opciones=array('conditions'=>"pagado='1' AND sala_id='1' AND fechareserva='".date("Y-m-d")." ".$salahora->hora.":00'");
										$reserva = Reserva::find($opciones);
										if(count($reserva)>0){?>
											<li><span><strong><?echo $salahora->hora?></strong> <em>Ocupado</em></span></li> 
										<?}else{?>
											<li><a href="#" class="reservahora" data="<?echo "1_".date("d-m-Y")."_".$salahora->hora?>"><strong><?echo $salahora->hora?></strong> <em>Libre</em></a></li> 
										<?}?>
									<?}
								}
							}?>
						</ul>

						<div id="datosreserva"></div>

						<form name="frmreserva" role="form" action="reserva-datos.php" method="post">
							<input type="hidden" name="OK" id="OK" value="1" >

							<input type="hidden" name="reservasala1" id="reservasala1" >
							<input type="hidden" name="reservafecha1" id="reservafecha1">
							<input type="hidden" name="reservahora1" id="reservahora1" >
							<input type="hidden" name="reservaprecio1" id="reservaprecio1"  >

							<input type="hidden" name="reservasala2" id="reservasala2" >
							<input type="hidden" name="reservafecha2" id="reservafecha2">
							<input type="hidden" name="reservahora2" id="reservahora2" >
							<input type="hidden" name="reservaprecio2" id="reservaprecio2">

							<div id="botonreserva">
								<p><strong>Seleccione fecha y hora pera realizar la reserva</strong></p>
							</div>
						</form>
					</section>

					<section class="4u 12u(mobile)">
						<header>
							<h2>Sala 2</h2>
							<p>(Máximo 5 personas)</p>
						</header>
						<!-- <p><strong>PRÓXIMAMENTE</strong></p> -->
						<div class="calendario2"></div>
					</section>

				</div>
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

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/bunkervalladolid.js"></script>

</body>

</html>