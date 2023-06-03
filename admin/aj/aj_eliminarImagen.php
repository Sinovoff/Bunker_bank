<?require("../init.php");

$directorio="../".$_GET['directorio'];

$_registro = $_GET['modelo']::find($_GET['id']);

$imagen=$_registro->{$_GET['campo']};
$rutaimagen=$directorio.$imagen;

if((!empty($imagen)) && (file_exists($rutaimagen)))	
	unlink($rutaimagen);

//Borrar los thumbnails si existen
$aMinis=array("m","a","l","g","p","90_","59_","20_");
foreach($aMinis as $mini){
	$imagenmini=$mini.$imagen;
	$rutaimagen=$directorio.$imagenmini;
	if((!empty($imagenmini)) && (file_exists($rutaimagen)))	
		unlink($rutaimagen);
}

$_registro->{$_GET['campo']}="";
$_registro->save();

$textoimagen="<input type=\"file\" name=\"".$_GET['nombrefile']."\" id=\"".$_GET['nombrefile']."\" class=\"form-control input-sm\" />";

echo $textoimagen;
?>