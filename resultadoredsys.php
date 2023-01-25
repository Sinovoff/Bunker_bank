<html> 
<body> 
<?require_once("init.php");
require_once("apiRedsys.php");

// Se crea Objeto
$miRedsys = new RedsysAPI;

//$TPV_CLAVE="sq7HjrUOBfKmC576ILgskD5srU870gJ7";//pruebas
$TPV_CLAVE="m6lD34ek/ZElMp/UUG8d/WAyZn3j64th";//real

if (!empty( $_POST ) ) {//URL DE RESP. ONLINE
	
	$version = $_POST["Ds_SignatureVersion"];
	$datos = $_POST["Ds_MerchantParameters"];
	$signatureRecibida = $_POST["Ds_Signature"];
	

	$decodec = $miRedsys->decodeMerchantParameters($datos);	
	$kc = $TPV_CLAVE;
	$firma = $miRedsys->createMerchantSignatureNotif($kc,$datos);	

	if ($firma === $signatureRecibida){
		$Ds_Response=$miRedsys->getParameter("Ds_Response");
		$idCompra=$miRedsys->getParameter("Ds_Order");

		if(($Ds_Response>='0000')&&($Ds_Response<='0099')) {
	
			$opciones = array('conditions'=>"idencriptado='".$idCompra."'");			
			$reserva = Reserva::find($opciones);
			$reserva->pagado="1";
			$reserva->save();

			$WEB="bunkervalladolid.es";
			$EMAIL="info@bunkervalladolid.es";
			$TELEFONO="983 10 38 08";


			//***** Descuento cupon **********
			$opciones= array('conditions'=>"activo='1' AND referencia='".$reserva->cupondescuento."'");	
			$cupone = Cupone::find($opciones);
			if(count($cupone)>0){
				$cupone->usado="1";
				$cupone->save();
			}

			$year=$reserva->fecha->format('Y');
			$mes=$reserva->fecha->format('m');
			$dia=$reserva->fecha->format('d');

			$meses=array("01"=>"Enero", "02"=>"Febrero", "03"=>"Marzo", "04"=>"Abril", "05"=>"Mayo", "06"=>"Junio", "07"=>"Julio", "08"=>"Agosto", "09"=>"Septiembre", "10"=>"Octubre", "11"=>"Noviembre", "12"=>"Diciembre");

			//**** Datos para el email ***
			//Detalle
			$detalle="<p style=\"font-size: 14px;\">Estimad@ <strong>".utf8_encode(strtoupper($reserva->nombre))."</strong></p>";

			$detalle.="<p>Este mensaje sirve para la confirmación de su reserva que se ha realizado el <strong>".$dia." de ".$meses[$mes]." de ".$year."</strong><br>Compruebe que los datos sean correctos, y si encuentra algún error por favor comuníquenoslo al siguiente email: <a href=\"mailto:".$EMAIL."\">".$EMAIL."</a></p>";


			$detalle.="<p>Su reserva se está procesando y los detalles de su compra son los siguientes:</p>";
			$detalle.="<p><strong style=\"font-size: 14px;color: #5f1b1b;\">DATOS DE LA RESERVA:</strong><br>";
			$detalle.="Referencia: <strong>".$reserva->idencriptado."</strong><br>";
			$detalle.="Sala: <strong>Sala ".$reserva->sala_id."</strong><br>";
			$detalle.="Fecha: <strong>".$reserva->fechareserva->format('d-m-Y')."</strong><br>";
			$detalle.="Hora: <strong>".$reserva->fechareserva->format('H:i')."</strong><br>";
			$detalle.="Precio: <strong>".$reserva->total."</strong><br>";
			$detalle.="Nombre: <strong>".$reserva->nombre."</strong><br>";
			if($reserva->empresa!="")	$detalle.="Empresa: <strong>".$reserva->empresa."</strong><br>";


			$detalle.="<p><strong>FORMA DE PAGO:</strong> TARJETA DE CRÉDITO</p>";

			$detalle.="<p><strong>Condiciones:</strong> ".$WEB." no tiene acceso a los datos de su tarjeta.</p>";
			
			
				
			$detalle.="<p>Gracias por confiar en <strong><a href=\"http://www.".$WEB."\">www.".$WEB."</a></strong><br /><br />";
			$detalle.="Reciba un cordial saludo<br /><br />";
			$detalle.="El equipo de administraci&oacute;n de <a href=\"http://www.".$WEB."\">".$WEB."</a></p>";

			//**Email
			$mensaje = join('', file(WEBPATH."emails/email.html"));

			$mensaje = str_replace("%%TITULO%%", "Reserva", $mensaje);
			$mensaje = str_replace("%%DETALLE%%", $detalle, $mensaje);
			$mensaje = str_replace("%%WEBROOT%%", $WEBROOT, $mensaje);
			$mensaje = str_replace("%%EMAIL%%", $EMAIL, $mensaje);
			$mensaje = str_replace("%%TELEFONO%%", $TELEFONO, $mensaje);
			$mensaje = str_replace("%%WEB%%", $WEB, $mensaje);
			//****************************
			
			//**Texto para el Email
			$emailFrom=$EMAIL;
			$emailReply=$EMAIL;

			$cabeceras="From: ".$emailFrom."\n";
			$cabeceras.="Reply-To: ".$emailReply."\n";
			$cabeceras.="MIME-Version: 1.0\n";
			$cabeceras.="Content-type: text/html; charset=UTF-8\n";

			$cuerpo=wordwrap($mensaje, 72);

			//Envio el mail
			mail($reserva->email, "Confirmación de reserva en ".$WEB, $cuerpo, $cabeceras);

			mail("info@bunkervalladolid.es", "Confirmación de reserva en  ".$WEB, $cuerpo, $cabeceras);

		}
	} else {
		//echo "FIRMA KO";
	}
}
?>
</body> 
</html> 