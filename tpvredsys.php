<?require_once("init.php");
require_once('apiRedsys.php');

// Se crea Objeto
$miRedsys = new RedsysAPI;

//$URLBANCO="https://sis-t.redsys.es:25443/sis/realizarPago";//pruebas
$URLBANCO="https://sis.redsys.es/sis/realizarPago"; //real

// Datos del comercio
//$TPV_IDCOMERCIO="344548615";				      // Por banco
$TPV_IDCOMERCIO="355701277";				      // Pruebas
$TPV_TERMINAL="1";							      // Por banco
//$TPV_CLAVE="sq7HjrUOBfKmC576ILgskD5srU870gJ7";  // pruebas
$TPV_CLAVE="jhs7qRzru1d5lo5VgPSfSbBt+23DV/Un";    // real dada por banco

// Valores de entrada
$TPV_ORDEN=$idencriptado;
$TPV_IMPORTE=number_format($TOTAL, 2, '.', '')*100;
$TPV_VERSION="HMAC_SHA256_V1";
$TPV_MONEDA="978";
$TPV_TIPOTRANSACCION="0";
$TPV_URLCOMERCIO=$WEBROOT."resultadoredsys.php";
$TPV_URLOK=$WEBROOT."respuestaredsysOK.php?Ds_Order=".$idencriptado;
$TPV_URLKO=$WEBROOT."respuestaredsysKO.php?Ds_Order=".$idencriptado;

// Se Rellenan los campos
$miRedsys->setParameter("DS_MERCHANT_AMOUNT",$TPV_IMPORTE);
$miRedsys->setParameter("DS_MERCHANT_ORDER",strval($TPV_ORDEN));
$miRedsys->setParameter("DS_MERCHANT_MERCHANTCODE",$TPV_IDCOMERCIO);
$miRedsys->setParameter("DS_MERCHANT_CURRENCY",$TPV_MONEDA);
$miRedsys->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$TPV_TIPOTRANSACCION);
$miRedsys->setParameter("DS_MERCHANT_TERMINAL",$TPV_TERMINAL);
$miRedsys->setParameter("DS_MERCHANT_MERCHANTURL",$TPV_URLCOMERCIO);
$miRedsys->setParameter("DS_MERCHANT_URLOK",$TPV_URLOK);		
$miRedsys->setParameter("DS_MERCHANT_URLKO",$TPV_URLKO);

// Se generan los parámetros de la petición
$request = "";
$TPV_PARAMETROS = $miRedsys->createMerchantParameters();
$TPV_FIRMA = $miRedsys->createMerchantSignature($TPV_CLAVE);
?>

<!DOCTYPE html>
<html lang="es-es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Conectando con la pasarela virtual...</title>
	<style type="text/css">
		#etiqueta{
			font-size: 16px;
			font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
			color: red;
			text-align:center;
		}
	</style>
</head>

<body>
	<div id="etiqueta">
		<p><strong><br /><br /><br /><br />Procesando operaci&oacute;n. <br /><br />Enviando datos a entidad Bancaria.<br /><br /><br /><br />Por favor espere...</strong></p>
	</div>

	<form name="frmRedsys" id="frmRedsys" action="<?echo $URLBANCO?>" method="post">		
		<input type="hidden" name="Ds_SignatureVersion" value="<?echo $TPV_VERSION?>"/>
		<input type="hidden" name="Ds_MerchantParameters" value="<?echo $TPV_PARAMETROS?>"/>
		<input type="hidden" name="Ds_Signature" value="<?echo $TPV_FIRMA?>"/>
	</form>

	<script language="JavaScript">
		<!--
		document.frmRedsys.submit();
		//-->
	</script>
</body>
</html>