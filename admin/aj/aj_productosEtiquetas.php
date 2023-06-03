<?require_once ("../init.php");
include ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	
	//********************************************
	//***********  ANADIR  ***********************
	//********************************************
	case "anadir":
		$etiquetaurl=formatear_titulourl($_POST['campo1']);

		$registro  = new $_POST['modelo']();
		$registro->producto_id  = $_POST['registro_id'];
		$registro->etiquetaurl	= $etiquetaurl;
		$registro->etiqueta		= $_POST['campo1'];
		$registro->save();

		$texto='';

		$texto.='<tr>';	
		
					if($registro->etiqueta==""){
						$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
					}else	
						$botonanadir=$registro->etiqueta;
		$texto.='	<td class="text-center">';
		$texto.='	  <div id="divtexto_etiqueta_'.$registro->id.'" class="divtexto" data="etiqueta">'.$botonanadir.'</div>';
		$texto.='	  <div id="divinput_etiqueta_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_etiqueta_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->etiqueta).'" data="etiqueta"/></div>';
		$texto.='	</td>';

		$texto.='	<td class="text-center"><a href="#" id="eliminarEtiqueta_'.$registro->id.'" class="eliminarEtiqueta" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a></td>';
		$texto.='</tr>';

		echo $texto;

		break;

	//********************************************
	//**********  MODIFICAR  *********************
	//********************************************
	case "modificar":
		$etiquetaurl=formatear_titulourl(utf8_decode($_POST['campo']));

		$registro  = $_POST['modelo']::find($_POST['id']);
		$registro->etiquetaurl	= $etiquetaurl;
		$registro->$_POST['camponombre']= utf8_decode($_POST['campo']);
		$registro->save();

		if(utf8_decode($_POST['campo'])=="")	$texto='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
		else									$texto=$_POST['campo'];

		echo $texto;

		break;
	
	//********************************************
	//***********  ELIMINAR  *********************
	//********************************************
	case "eliminar":
		$parte_id=explode("_",$_POST['elemento_id']);
		$productoregistro_id=$parte_id[1];
		$Modelo=$_POST['modelo'];

		$_registro = $Modelo::find($productoregistro_id);
		$_registro->delete();

		break;

}
?>