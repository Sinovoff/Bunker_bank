<?require_once ("init.php");

$opciones=array('conditions'=>"provincia='".utf8_decode(trim($_POST['provincia']))."'");
$provincia = Provincia::find($opciones);

$provincia_id=str_pad($provincia->id, 2 , "0", STR_PAD_LEFT);   

$opciones=array('conditions'=>"provincia_id='".$provincia_id."'",  'order' =>"poblacion");
$aPoblaciones = Poblacione::find("all",$opciones);

$texto='<option value="" selected="selected">-Seleccione-</option>';
foreach($aPoblaciones as $poblacion){
	$texto.='<option value="'.utf8_encode($poblacion->poblacion).'">'.utf8_encode($poblacion->poblacion).'</option>';
}
echo $texto;
?>