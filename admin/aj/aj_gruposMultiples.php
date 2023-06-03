<?//************** NOTICIAS-GRUPOS ************************
require_once ("../init.php");
include ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	

	//*********  ANADIR  ***********************
	case "anadir":
		$registro  = new Noticiasgrupo();
		$registro->noticia_id	= $_POST['noticia_id'];
		$registro->grupo_id		= $_POST['grupo_id'];
		$registro->save();

		$texto='';
		$texto.='<tr>';	
		
		$texto.='	<td>'.utf8_encode(stripslashes($registro->grupo->grupo)).'</td>';

		$texto.='	<td  class="text-center">';
		$texto.='		<a href="#" id="eliminarNoticiagrupo_'.$registro->id.'" class="eliminarNoticiagrupo" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a>';
		$texto.='	</td>';
		
		$texto.='</tr>';

		echo $texto;
		

		break;

	//*********  ELIMINAR  *********************
	case "eliminar":
		// *** Eliminar genero
		$parte_id=explode("_",$_POST['elemento_id']);
		$noticiagrupo_id=$parte_id[1];
		$Modelo=$_POST['modelo'];

		$_registro = Noticiasgrupo::find($noticiagrupo_id);
		$_registro->delete();

		break;

}
?>