<?require_once("../init.php");

//Activar usuario
$usuario=Usuario::find($_POST['usuario_id']);
$usuario->activo=1;

$usuario->save();

//***************************  Envio email  **************************
//**** Datos para el email ***
$WEB="aliatasaciones.com";
$EMAIL="info@aliatasaciones.com";
$TELEFONO="902 12 24 00";

//Detalle
$detalle.="Su cuenta ha sido activada<br /><br />";

$detalle.="<strong style=\"font-size: 14px;color: #222565;\">Datos de acceso a la web:</strong><br />";
$detalle.="<strong>Email:</strong> ".$usuario->email."<br />";
$detalle.="<strong>Contraseña:</strong> ".$usuario->password."<br /><br />";

$detalle.="Un cordial saludo<br /><br />";
$detalle.="El equipo de administraci&oacute;n de <a href=\"http://www.".$WEB."\">".$WEB."</a>";

//Email
$mensaje = join('', file(WEBPATH."emails/email.html"));

$mensaje = str_replace("%%TITULO%%", "Datos de acceso", $mensaje);
$mensaje = str_replace("%%DETALLE%%", $detalle, $mensaje);
$mensaje = str_replace("%%WEBROOT%%", WEBROOTSEGURO, $mensaje);
$mensaje = str_replace("%%EMAIL%%", $EMAIL, $mensaje);
$mensaje = str_replace("%%TELEFONO%%", $TELEFONO, $mensaje);
$mensaje = str_replace("%%WEB%%", $WEB, $mensaje);
//****************************

$emailDe=$EMAIL;

$cabeceras ="From: ".$emailDe." \n";
$cabeceras.="Reply-To: ".$emailDe."\n";
$cabeceras.="MIME-Version: 1.0\n";
$cabeceras.="Content-type: text/html; charset=UTF-8\n";

$cuerpo=wordwrap($mensaje, 72);

//Envio el mail
mail($usuario->email, "Datos de acceso a ".$WEB, $cuerpo, $cabeceras);
//mail("eduardo.baladron@digival.es", "Datos de acceso a ".$WEB, $cuerpo, $cabeceras);


echo "Se ha activado la cuenta y enviado el email de acceso";
?>