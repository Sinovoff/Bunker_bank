<?require_once ("../init.php");

// array con el nuevo orden de nuestros registros
$articulos_ordenados 	= $_POST['registro'];
$pos = 1;
$Modelo=$_POST['modelo'];

if($Modelo=="Producto")	$Modelo="Productossubcategoria";

foreach ($articulos_ordenados as $key) {
	if($Modelo=="Productossubcategoria"){
		if(($_POST['seccione_id']!="")&&($_POST['categoria_id']!="")&&($_POST['subcategoria_id']!="")){
			$opciones= array('conditions' => "producto_id='".$key."' AND seccione_id='".$_POST['seccione_id']."' AND categoria_id='".$_POST['categoria_id']."'  AND subcategoria_id='".$_POST['subcategoria_id']."'");	
			$productosubcategoria = Productossubcategoria::find($opciones);
			$key=$productosubcategoria->id;
		}else if(($_POST['seccione_id']!="")&&($_POST['categoria_id']!="")){
			$opciones= array('conditions' => "producto_id='".$key."' AND seccione_id='".$_POST['seccione_id']."' AND categoria_id='".$_POST['categoria_id']."' AND subcategoria_id='0'");	
			$productosubcategoria = Productossubcategoria::find($opciones);
			$key=$productosubcategoria->id;
		}else if($_POST['seccione_id']!=""){
			$opciones= array('conditions' => "producto_id='".$key."' AND seccione_id='".$_POST['seccione_id']."' AND categoria_id='0' AND subcategoria_id='0'");	
			$productosubcategoria = Productossubcategoria::find($opciones);
			$key=$productosubcategoria->id;
		}
	}


	$opciones= array('conditions' => "id='".$key."'");	
	$registro = $Modelo::find($opciones);

	$registro->orden=$pos;
	$registro->save();
	
	$pos++;
}
?>