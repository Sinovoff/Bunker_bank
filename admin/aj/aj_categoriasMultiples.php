<?//************** SECCION-CATEGORIA-SUBCATEGORIA ************************
require_once ("../init.php");
include ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	

	//*********  ANADIR  ***********************
	case "anadir":
		if($_POST['tipo']=="seccioncategoria"){
			$registro  = new Noticiascategoria();
			$registro->noticia_id		= $_POST['noticia_id'];
			$registro->seccione_id		= $_POST['seccione_id'];
			$registro->categoria_id		= $_POST['categoria_id'];
			$registro->save();

			$texto='';
			$texto.='<tr>';	
			
			$texto.='	<td>'.utf8_encode(stripslashes($registro->seccione->seccion)).'</td>';
			
			$texto.='	<td>'.utf8_encode(stripslashes($registro->categoria->categoria)).'</td>';

			$texto.='	<td  class="text-center">';
			$texto.='		<a href="#" id="eliminarSeccioncategoria_'.$registro->id.'" class="eliminarSeccioncategoria" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a>';
			$texto.='	</td>';
			
			$texto.='</tr>';

			echo $texto;
			
		}else if($_POST['tipo']=="seccionsubcategoria"){
			$registro  = new Productossubcategoria();
			$registro->producto_id		= $_POST['producto_id'];
			$registro->seccione_id		= $_POST['seccione_id'];
			$registro->categoria_id		= $_POST['categoria_id'];
			$registro->subcategoria_id	= $_POST['subcategoria_id'];
			$registro->save();

			$texto='';
			$texto.='<tr>';	
			
			$texto.='	<td>'.utf8_encode(stripslashes($registro->seccione->seccion)).'</td>';
			
			//$texto.='	<td>'.utf8_encode(stripslashes($registro->categoria->categoria)).'</td>';

			//$texto.='	<td>'.utf8_encode(stripslashes($registro->subcategoria->subcategoria)).'</td>';

			$texto.='	<td  class="text-center">';
			$texto.='		<a href="#" id="eliminarSeccionsubcategoria_'.$registro->id.'" class="eliminarSeccionsubcategoria" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a>';
			$texto.='	</td>';
			
			$texto.='</tr>';

			echo $texto;
		}

		break;

	//*********  ELIMINAR  *********************
	case "eliminar":
		if($_POST['tipo']=="seccioncategoria"){
			// *** Eliminar genero
			$parte_id=explode("_",$_POST['elemento_id']);
			$usuariodireccion_id=$parte_id[1];
			$Modelo=$_POST['modelo'];

			$_registro = Noticiascategoria::find($usuariodireccion_id);
			$_registro->delete();

		}else if($_POST['tipo']=="seccionsubcategoria"){
			// *** Eliminar genero
			$parte_id=explode("_",$_POST['elemento_id']);
			$usuariodireccion_id=$parte_id[1];
			$Modelo=$_POST['modelo'];

			$_registro = Productossubcategoria::find($usuariodireccion_id);
			$_registro->delete();
		}
		
		break;

	//********  CAMBIO SELECT  ******************
	case "cambioselect":
		if($_POST['tipo']=="categoria"){
			$opciones= array('conditions' => "seccione_id='".$_POST['seccione_id']."' AND categoria_id='".$_POST['categoria_id']."'", "order"=>"orden");	
			$aSubcategorias = Subcategoria::find("all", $opciones);

			$selectsubcategoria='<option value="0" selected="selected">-Seleccione-</option>';
			if(count($aSubcategorias)>0){
				foreach($aSubcategorias as $subcategoria){
					$selectsubcategoria.='<option value="'.$subcategoria->id.'" >'.utf8_encode($subcategoria->subcategoria).'</option>';
				}
			}

			echo $selectsubcategoria;

		}else if($_POST['tipo']=="seccion"){
			$opciones= array('conditions' => "noticiasseccione_id='".$_POST['noticiasseccione_id']."'", "order"=>"orden");	
			$aNoticiascategorias = Noticiascategoria::find("all", $opciones);

			$selectcategoria='<option value="0" selected="selected">-Seleccione-</option>';
			if(count($aNoticiascategorias)>0){
				foreach($aNoticiascategorias as $noticiacategoria){
					$selectcategoria.='<option value="'.$noticiacategoria->id.'" >'.utf8_encode($noticiacategoria->titulo).'</option>';
				}
			}

			echo $selectcategoria;
		}
		break;


}
?>