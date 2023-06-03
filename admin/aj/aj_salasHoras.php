<?require_once ("../init.php");
include ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	
	//********************************************
	//***********  ANADIR  ***********************
	//********************************************
	case "anadir":
		$registro  = new $_POST['modelo']();
		$registro->sala_id		= $_POST['registro_id'];
		$registro->hora			= $_POST['campo1'];
		$registro->diasemana	= $_POST['campo2'];
		$registro->save();


		$texto='';

		$texto.='<tr>';

		$texto.='	<td class="text-center">';
			if($registro->hora==""){	
				$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
			}else	
				$botonanadir=utf8_encode(stripslashes($registro->hora));
			
		$texto.='		<div id="divtextohora_hora_'.$registro->id.'" class="divtextohora" data="hora">'.$botonanadir.'</div>';
		$texto.='		<div id="divinputhora_hora_'.$registro->id.'" style="display:none"><input type="text" name="inputcampohora" id="inputcampohora_hora_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->hora).'" data="hora"></div>';
		$texto.='	</td>';

		$texto.='	<td class="text-center">';
			if($registro->diasemana==""){	
				$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
			}else	
				$botonanadir=utf8_encode(stripslashes($registro->diasemana));
			
		$texto.='		<div id="divtextohora_diasemana_'.$registro->id.'" class="divtextodiasemana" data="diasemana">'.$botonanadir.'</div>';
		$texto.='		<div id="divinputhora_diasemana_'.$registro->id.'" style="display:none"><input type="text" name="inputcampodiasemana" id="inputcampohora_diasemana_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->diasemana).'" data="diasemana"></div>';
		$texto.='	</td>';


		$texto.='	<td class="text-center"><a href="#" id="eliminarHora_'.$registro->id.'" class="eliminarHora" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar"></a></td>';
		
		
		$texto.='</tr>';


		$aTextos=array(	'texto' => $texto);

		echo json_encode($aTextos);

		break;

	//********************************************
	//**********  MODIFICAR  *********************
	//********************************************
	case "modificar":
		$camponombre=$_POST['camponombre'];

		$registro  = $_POST['modelo']::find($_POST['id']);
		$registro->{$camponombre}= utf8_decode($_POST['campo']);
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