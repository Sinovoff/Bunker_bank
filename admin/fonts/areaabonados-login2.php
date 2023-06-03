<?include ("header.php");?>


<div class="row-fluid">
	<div class="span12 ficha bordered">
		<img src="images/abonados/RV-CampanaAbonados.jpg" width="940" height="330" alt="EL REAL VALLADOLID ES PARTE DE TU VIDA">
	</div>
</div>

<div class="row-fluid">

	<?//******    Abonados    ***************************************?>
	<div class="span12 text-justify">
		
		<h2 class="text-center morado">&Aacute;rea de abonados - Renovaci&oacute;n carn&eacute; temporada 17/18 </h2>

		<?if($_POST['OK']=="1") {
			$nif=addslashes($_POST['nif']);
			$pin=addslashes($_POST['pin']);

			if (($nif!="")&&($pin!="")) {
				$opciones=array('conditions'=>"nif='".$nif."' AND CAST(pin AS BINARY)=CAST('".$pin."' AS BINARY)");
				$abonadocarnet=Abonadoscarnet::find($opciones);

				if(count($abonadocarnet)>0) {
					$_SESSION['IDUABONADO']=$abonadocarnet->id;
					$_SESSION['UIDABONADO']=$abonadocarnet->idencriptado;
					$_SESSION['USUARIOABONADO']=$abonadocarnet->nombre;

					
					$ERRORABONADO="0";?>
					<script language="JavaScript">window.document.location.href='<?echo $WEBROOT?>area-abonados/carne/';</script>
				<?}else{
					$ERRORABONADO="1";
				}
			}else{
				$ERRORABONADO="1";
			}
		}

		if(isset($_SESSION['IDUABONADO']) && ($_SESSION['IDUABONADO']>0)){/*?>
			<script language="JavaScript">window.document.location.href='<?echo $WEBROOT?>area-abonados/carne/';</script>
		<?*/}?>
			
		<?/*	<p class="text-center">Para renovar su carn&eacute; de abonado, introduzca los siguientes datos:</p>

			<form name="frmAbonados" id="frmAbonados" class="renovacion-online" action="area-abonados/login/" method="post">	
				<input type="hidden" name="OK" id="OK" value="1" />					

				<p><input type="text" name="nif" id="nif" class="obligatorio" placeholder="D.N.I." /><br />
				<input type="password" name="pin" id="pin" class="obligatorio" placeholder="C&oacute;digo PIN" /></p>

				<?if ($ERRORABONADO=='1'){?>
					<p class="errorForm"><strong>ERROR</strong> datos incorrectos</p>
				<?}?>

				<p><button name="btnEnviar" id="btnEnviar" type="submit" class="btn btn-primary">Entrar</button></p>
			
				<p><a style="cursor: help" title="<img src='images/abonados/RV_AyudaPin.png' width='200' height='150'/><br>C&oacute;digo n&uacute;merico que se encuentra junto al c&oacute;digo de barras, debajo del campo FILA en el carn&eacute; de abonado" data-toggle="tooltip" rel="tooltip">Como encontrar tu c&oacute;digo PIN</a></p>
			</form>
		
		*/ ?>
		
		<p class="text-center morado fsizebig mtop20"><strong>Renovaciones online a partir del 3 de julio</strong></p>

		<hr>

	</div>
</div>

<?include "footer.php";?>