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

                    <?//*** Menu superior ***
					include("menu-superior.php");
					//***********************?>

                </div>

            </div>

            <!-- Main Wrapper -->
            <div id="main-wrapper">

                <div id="intro" class="container">
                                        
					<div class="row">

                         <section id="content" class="container">
							  <header>
								<h2>Rellene el siguiente formulario para realizar la reserva</h2> 
								<h3 style="color:#ffff00"><u>IMPORTANTE</u><br> PARA RESERVAS CON MENOS DE 24 HORAS  O CON CARNÉ JOVEN,<BR> CONFIRMAR PREVIAMENTE POR TLF ANTES DE HACER LA RESERVA.</h3>
							</header>

							<form name="frmreservadatos" role="form" action="reserva-finalizar.php" method="post">
								<input type="hidden" name="OK" id="OK" value="1" >								

								<?/*<input type="hidden" name="reservasala2" id="reservasala2"  value="<?echo $_POST['reservasala2']?>">
								<input type="hidden" name="reservafecha2" id="reservafecha2" value="<?echo $_POST['reservafecha2']?>">
								<input type="hidden" name="reservahora2" id="reservahora2"  value="<?echo $_POST['reservahora2']?>">
								<input type="hidden" name="reservaprecio2" id="reservaprecio2" value="<?echo $_POST['reservaprecio2']?>">*/?>

								<?/*$aPaises=	Paise::find_all_by_activo('1',array('order' => pais));
	
								$opciones= array('conditions'=>"activo='1'", 'order' => "provincia");			
								$aProvincias = Provincia::find("all",$opciones);*/?>


								<p><input type="text" name="nombre" id="nombre" placeholder="* Nombre" required size="60"></p>
								<p><input type="text" name="apellidos" id="apellidos" placeholder="* Apellidos"  required size="60"></p>
								<p><input type="text" name="empresa" id="empresa" placeholder="Empresa"  size="60"></p>
								<p><input type="text" name="direccion" id="direccion" placeholder="* Dirección"  required size="60"></p>
								<p><input type="text" name="cp" id="cp" placeholder="* C.P." required size="60"></p>
								<p><input type="text" name="provincia" id="provincia" placeholder="* Provincia"  required size="60"></p>
								<p><input type="text" name="poblacion" id="poblacion" placeholder="* Población"  required size="60"></p>
								<p><input type="tel" name="telefono" id="telefono" placeholder="* Teléfono" required  size="60"></p>
								<p><input type="email" name="email" id="email" placeholder="* Email"  required  size="60"></p>
								<p><input type="text" name="observaciones" id="observaciones" placeholder="Observaciones"  size="60"></p>


								
								<?/*<p><select name="paise_id" id="paise_id">
									<?foreach($aPaises as $pais){
										$selected ="";
										if($pais->id == "69"){ $selected = "selected='selected'";}?>
										<option value="<?echo $pais->id?>" <?echo $selected?>><?echo utf8_encode($pais->pais)?></option>
									<?}?>
								</select></p>

								<p><select name="provincia" id="provincia" required size="60">
									<option value="" selected="selected">-Seleccione provincia-</option>
									<?foreach($aProvincias as $provincia){	
										$selected ="";
										if($provincia->provincia == $_POST['provincia']){ $selected = "selected='selected'";}?>
										<option value="<?echo utf8_encode($provincia->provincia)?>"  <? echo $selected?>><?echo utf8_encode($provincia->provincia)?></option>
									<?}?>
								</select>
								<input type="text" name="provinciatexto" id="provinciatexto" value="<?echo $_POST['provincia']?>">	</p>			
							
								<p><select name="poblacion" id="poblacion" required size="60">
									<option value="" selected="selected">-Seleccione población-</option>
									<?if($aPoblaciones>0){
										foreach($aPoblaciones as $poblacion){
											$selected ="";
											if($poblacion->poblacion == $_POST['poblacion']){ $selected = "selected='selected'";}?>
											<option value="<?echo utf8_encode($poblacion->poblacion)?>"  <?echo $selected?>><? echo utf8_encode($poblacion->poblacion)?></option>
										<?}
									}?>
								</select>
								<input type="text" name="poblaciontexto" id="poblaciontexto"  value="<?echo $_POST['poblacion']?>">	</p>	
								*/?>
							

								<p><strong>Forma de pago:</strong> Tarjeta de crédito</p>

								<h3>DATOS DE LA RESERVA</h3>

								<p><strong>Sala:</strong> Sala <?echo $_POST['reservasala1']?></p>

								<p><strong>Día:</strong> <?echo $_POST['reservafecha1']?></p> 

								<p><strong>Hora:</strong> <?echo $_POST['reservahora1']?></p>

								<p><strong>Precio:</strong> <?echo $_POST['reservaprecio1']?> €</p>

								<h3>Cúpon descuento</h3>
								<p>
									<input type="text" name="cupondescuento" id="cupondescuento" placeholder="Cupón descuento" size="20">
									<div id="mensajedescuento" class="centro mbottom20"></div>
									<button type="button" class="button buscarcupon">Comprobar cupón</button>

									<div  id="lineadetextodescuento"><?echo $textodescuento?></div>
								</p>

								<p class="preciototal">TOTAL: <strong><?echo $_POST['reservaprecio1']?> €</strong></p>

								<p><label><input type="checkbox" name="terminos1" id="terminos1" value="ok" /> <a class="condiciones" href="avisos-legales.php" title="Condiciones" target="_blank">* He leído y acepto los avisos legales</a></label></p>
								<p><label><input type="checkbox" name="comunicaciones1" id="comunicaciones1" /> <a class="condiciones" href="comunicaciones.php" title="Comunicaciones" target="_blank"> Acepto en envío de futuras promociones o novedades</a></label></p>
			
								<p class="small derecha">* Campos obligatorios</p>

								<input type="hidden" name="reservasala1" id="reservasala1" value="<?echo $_POST['reservasala1']?>">
								<input type="hidden" name="reservafecha1" id="reservafecha1" value="<?echo $_POST['reservafecha1']?>">
								<input type="hidden" name="reservahora1" id="reservahora1"  value="<?echo $_POST['reservahora1']?>">
								<input type="hidden" name="reservaprecio1" id="reservaprecio1"   value="<?echo $_POST['reservaprecio1']?>">

								<input type="hidden" name="TOTAL" id="TOTAL"   value="<?echo $_POST['reservaprecio1']?>">


								<p><button type="submit" class="button button-big">FINALIZAR RESERVA</button></p>
							</form>
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
		<script src="js/descuento.js"></script>
		<script src="js/validaciones.min.js"></script>

    </body>

    </html>