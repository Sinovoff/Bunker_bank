
<!DOCTYPE HTML>
<html>

<head>
	<title>Reservas - The Bunker Escape Room</title>
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

				<?php
				//*** Menu superior ***
				include("menu-superior.php");
				//***********************
				?>

			</div>

		</div>

		<!-- Main Wrapper -->
		<div id="main-wrapper">

			<div id="intro" class="container">
									

					<?if ($_GET['ref']!="")	$idCompra=$_GET['ref'];
					$registroReserva = Reserva::find_by_idencriptado($idCompra);

					if(count($registroReserva) > 0){
						if($registroReserva->pagado==1)	$error=0;
						else							$error=1;
					}else{
						$error=1; //Si no existe la orden es que habido un error
					}
					if(!$error) {?>
						<h2 style="text-center:center">Compra finalizada</h2>
						<p class="centro mtop20">Gracias por confiar en el servicio de venta on-line</p>
						<p class="centro">Su pedido está siendo procesado, en breve recibirá un email con los detalles.</p>
						<?/*<p class="centro"><a href="<?echo $WEBROOTSEGURO?>imprimir/<?echo $idCompra?>/" target="_blank" title="Imprimir Pedido"><strong>Imprimir Pedido</strong></a></p>*/?>

					<?}else{?>
						<h2>Transacción Denegada</h2>
						<p>La operación de compra no ha sido realizada.<br>
						¿Ha surgido algún problema o tiene dudas?<br>
						Póngase en contacto con nosotros<br>
						</p>
						<p><a href="tel:+34983103808">Tlf. 983 10 38 08</a> - <a href="mailto:info@bunkervalladolid.es">info@bunkervalladolid.es</a></p>
					<?}?>		


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

	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/bunkervalladolid.js"></script>
	<script src="js/valid_form.min.js"></script>

</body>

</html>