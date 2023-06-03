<?require_once ("../init.php");
require_once ("../funciones_imagenes.php");
require_once ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	

	//********************************************
	//*************  ANADIR  *********************
	//********************************************
	case "anadir":
		if(isset($_POST)){
			$Modelo=$_POST['ModeloTablaArchivos'];
			$directorio=$_POST['directorioarchivos'];
			$camporelacion=$_POST['campoarchivosrelacion'];
			$camporelacion_id=$_POST[$camporelacion];
						
			$texto="";

			$nombrearchivo=guardar_imagen_bd_multiple("archivocampo2", $Modelo, $camporelacion_id."a", "../../".$directorio,"");	
			$aNombrearchivo=explode(",",$nombrearchivo);

			foreach($aNombrearchivo as $nombrearchivo){			
				//Calcular el orden siguiente si el campo orden esta vacio
				$options = array('conditions' => $camporelacion."='".$camporelacion_id."'", 'limit' => 1, 'offset' => 0, 'order' => "orden DESC",);	
				$registro = $Modelo::find($options);
				$orden=$registro->orden+1;


				$registro  = new $Modelo();
				$registro->$camporelacion = $camporelacion_id;
				$registro->nombre		  = utf8_decode(addslashes($_POST['archivocampo1']));
				$registro->orden		  =	$orden;
				$registro->archivo        = $nombrearchivo;
				$registro->save();


				$texto.='<div class="col-md-3 cajaarchivos" id="cajaarchivos-'.$registro->id.'">';

				$texto.='	<div class="clasecabecera">';
				$texto.='		<div class="row">';
				$texto.='			<div class="claseorden claseordenarchivo col-md-6 col-sm-6 col-xs-6">';
				$texto.='				<strong>'.stripslashes($registro->orden).'</strong>';
				$texto.='			</div>';

				$texto.='			<div class="claseeliminar col-md-6 col-sm-6 col-xs-6">';
				$texto.='				<a href="#" id="eliminarArchivo_'.$registro->id.'" class="eliminarArchivo" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a>';
				$texto.='			</div>';
				$texto.='		</div>';
				$texto.='	</div>';

				$texto.='	<div class="clasetitulo">';
								if($registro->nombre==""){
									$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
								}else	
									$botonanadir='<span style="padding-top:8px;position:relative;display:block;">'.stripslashes($registro->nombre).'</span>';
				
				$texto.='		<div id="divtextoarchivo_nombre_'.$registro->id.'" class="divtextoarchivo" data="nombre">'.$botonanadir.'</div>';
				$texto.='		<div id="divinputarchivo_nombre_'.$registro->id.'" style="display:none"><input type="text" name="inputcampoarchivo" id="inputcampoarchivo_nombre_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->nombre).'" data="nombre"/></div>';
				$texto.='	</div>';


				$texto.='	<div class="claseimagen  text-center">';
								if (!empty($nombrearchivo)){
									$palabras=explode(".",$registro->archivo);
									$extension=$palabras[count($palabras)-1];
									if (($extension=="jpg") || ($extension=="JPG") || ($extension=="gif") ||  ($extension=="GIF") || ($extension=="png") || ($extension=="PNG")){	
																	$icono="jpggrande.png";
									}else if ($extension=="doc"){	$icono="docgrande.png";
									}else if ($extension=="zip"){	$icono="zipgrande.png";
									}else if ($extension=="rar"){	$icono="rargrande.png";
									}else if ($extension=="txt"){	$icono="txtgrande.png";
									}else{							$icono="pdfgrande.png";
									}
				$texto.='		<a href="../'.$directorio.$nombrearchivo.'" title="'. stripslashes($registro->archivo).'" target="_blank"><img src="images/'.$icono.'" />'.$nombrearchivo.'</a>';
								}
				$texto.='	</div>';
				
				$texto.='</div>';
			}
			echo $texto;
		}
		break;

	

	//********************************************
	//**********  MODIFICAR  *********************
	//********************************************
	case "modificar":
		$registro  = $_POST['modelo']::find($_POST['id']);
		$registro->$_POST['camponombre']= utf8_decode($_POST['campo']);
		$registro->save();

		if(utf8_decode($_POST['campo'])=="")	$texto='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
		else									$texto='<span style="padding-top:8px;position:relative;display:block;">'.$_POST['campo'].'</span>';

		echo $texto;

		break;
	


	//********************************************
	//***********  ELIMINAR  *********************
	//********************************************
	case "eliminar":
		$parte_id=explode("_",$_POST['elemento_id']);
		$productoregistro_id=$parte_id[1];
		$Modelo=$_POST['modelo'];

		$_registroimagen = $Modelo::find($productoregistro_id);
		$imagen=$_registroimagen->archivo;

		$directorio="../../".$_POST['directorio'];
		$rutaimagen=$directorio.$imagen;
		if((!empty($imagen)) && (file_exists($rutaimagen)))	
			unlink($rutaimagen);

		//Borrar los thumbnails si existen
		/*$aMinis=array("m","l","a","g","f");
		foreach($aMinis as $mini){
			$imagenmini=$mini.$imagen;
			$rutaimagen=$directorio.$imagenmini;
			if((!empty($imagenmini)) && (file_exists($rutaimagen)))	
				unlink($rutaimagen);
		}*/

		$_registroimagen->delete();

		break;
	
	//********************************************
	//***********  ORDENAR  *********************
	//********************************************
	case "ordenar":
		// array con el nuevo orden de nuestros registros
		$articulos_ordenados 	= $_POST['cajaarchivos'];
		$pos = 1;

		$Modelo=$_POST['modelo'];

		foreach ($articulos_ordenados as $key) {

			$opciones= array('conditions' => "id='".$key."'");	
			$registro = $Modelo::find($opciones);

			$registro->orden=$pos;
			$registro->save();
			
			$pos++;
		}
		break;
}
?>