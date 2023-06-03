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
			$Modelo=$_POST['ModeloTablaImagenes'];
			$directorio=$_POST['directorioimagenes'];
			$camporelacion=$_POST['campoimagenesrelacion'];
			$camporelacion_id=$_POST[$camporelacion];
						
			$texto="";

			$nombreimagen=guardar_imagen_bd_multiple("imagencampo3", $Modelo, $camporelacion_id."_n","../../".$directorio,"");	
			$aNombreimagen=explode(",",$nombreimagen);

			foreach($aNombreimagen as $nombreimagen){
				if($Modelo=="Serviciosimagene"){
					if($nombreimagen!=""){
						$nombremini=thumbnail($nombreimagen,"../../".$directorio,"../../".$directorio,"1500","900","");
						$nombremini=thumbnail_conRecorte_Centrado($nombreimagen,"../../".$directorio,"../../".$directorio,"550","400","l");
						$nombremini=thumbnail_conRecorte_Centrado($nombreimagen,"../../".$directorio,"../../".$directorio,"500","300","m");
					}
				}else{
					if($nombreimagen!=""){
						$nombremini=thumbnail($nombreimagen,"../../".$directorio,"../../".$directorio,"1150","767","");
						$nombremini=thumbnail_conRecorte_Centrado($nombreimagen,"../../".$directorio,"../../".$directorio,"375","250","l");
					}
				}

				//Calcular el orden siguiente si el campo orden esta vacio
				$options = array('conditions' => $camporelacion."='".$camporelacion_id."'", 'limit' => 1, 'offset' => 0, 'order' => "orden DESC",);	
				$registro = $Modelo::find($options);
				$orden=$registro->orden+1;

				//**SELECT colores activar solo si existe **
				//$opciones = array('order' => "color");			
				//$aColores = Colore::find("all",$opciones);
				//******************************************


				$registro  = new $Modelo();
				$registro->$camporelacion	= $camporelacion_id;
				$registro->nombre			= utf8_decode(addslashes($_POST['imagencampo1']));
				//$registro->colore_id		= utf8_decode(addslashes($_POST['imagencampo4']));
				$registro->pie				= utf8_decode(addslashes($_POST['imagencampo2']));
				$registro->orden			= $orden;
				$registro->imagen			= $nombreimagen;
				$registro->save();


				$texto.='<div class="col-md-3 col-sm-4 col-xs-12 cajaimagenes" id="cajaimagenes-'.$registro->id.'">';
				$texto.='	<div class="clasecabecera">';
				$texto.='		<div class="row">';
				$texto.='			<div class="claseorden claseordenimagenes col-md-6 col-sm-6 col-xs-6">';
				$texto.='				<strong>'.stripslashes($registro->orden).'</strong>';
				$texto.='			</div>';

				$texto.='			<div class="claseeliminar col-md-6 col-sm-6 col-xs-6">';
				$texto.='				<a href="#" id="eliminarImagen_'.$registro->id.'" class="eliminarImagen" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" /></a>';
				$texto.='			</div>';
				$texto.='		</div>';
				$texto.='	</div>';

				$texto.='	<div class="clasetitulo">';
								if($registro->nombre==""){
									$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
								}else	
									$botonanadir='<span style="padding-top:8px;position:relative;display:block;">'.stripslashes($registro->nombre).'</span>';
				
				$texto.='		<div id="divtextoimagen_nombre_'.$registro->id.'" class="divtextoimagen" data="nombre">'.$botonanadir.'</div>';
				$texto.='		<div id="divinputimagen_nombre_'.$registro->id.'" style="display:none"><input type="text" name="inputcampoimagen" id="inputcampoimagen_nombre_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->nombre).'" data="nombre"/></div>';
				$texto.='	</div>';

				if($Modelo=="Hospitalesproductosimagene"){
					$texto.='	<div class="claseimagen">';
									if (!empty($nombreimagen)){
					$texto.='		<a href="../'.$directorio.$nombreimagen.'" title="'. stripslashes($registro->nombre).'" class="gallery" ><img src="../'.$directorio.$nombreimagen.'" class="img-responsive" width="150"/></a></td>';
									}
					$texto.='	</div>';

				}else if($Modelo=="Industrialesproductosimagene"){
					$texto.='	<div class="claseimagen">';
									if (!empty($nombreimagen)){
					$texto.='		<a href="../'.$directorio.$nombreimagen.'" title="'. stripslashes($registro->nombre).'" class="gallery" ><img src="../'.$directorio.$nombreimagen.'" class="img-responsive" width="150"/></a></td>';
									}
					$texto.='	</div>';
				}else{
					$texto.='	<div class="claseimagen">';
									if (!empty($nombreimagen)){
					$texto.='		<a href="../'.$directorio.$nombreimagen.'" title="'. stripslashes($registro->nombre).'" class="gallery" ><img src="../'.$directorio.'l'.$nombreimagen.'" class="img-responsive" width="150"/></a></td>';
									}
					$texto.='	</div>';
				}

				/*$texto.='	<div class="claseimagen">';
								if($registro->pie==""){
									$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
								}else	
									$botonanadir='<span style="padding-top:8px;position:relative;display:block;">'.stripslashes($registro->pie).'</span>';

				$texto.='		<div id="divtextoimagen_pie_'.$registro->id.'" class="divtextoimagen" data="pie">'.$botonanadir.'</div>';
				$texto.='		<div id="divinputimagen_pie_'.$registro->id.'" style="display:none"><input type="text" name="inputcampoimagen" id="inputcampoimagen_pie_'.$registro->id.'" class="form-control input-sm" value="'.stripslashes($registro->pie).'" data="pie"/></div>';
				$texto.='	</div>';*/


				//*** Si tiene colores activar ***
				/*
				$texto.='	<div class="claseimagen">';
								if($registro->colore_id=="0"){
									$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
								}else{
									$botonanadir ='<span style="padding-top:8px;position:relative;display:block;">';
									$botonanadir.='		<label style="background:'.stripslashes($registro->colore->paleta).';width: 24px; height:24px;"></label>';
									$botonanadir.='		<span style="padding-left:28px;position:relative;display:block;margin-top:-30px;">'.stripslashes($registro->colore->color).'</span>';
									$botonanadir.='	</span>';
								}
				
				$texto.='	  	<div id="divtextoimagenselect_coloreid_'.$registro->id.'" class="divtextoimagenselect" data="coloreid">'. $botonanadir.'</div>';
				$texto.='	  	<div id="divinputimagenselect_coloreid_'.$registro->id.'" style="display:none">';
				$texto.='	  		<select name="inputcampoimagenselect" id="inputcampoimagenselect_coloreid_'.$registro->id.'" class="inputcampoimagenselect form-control input-sm" data="coloreid">';
				$texto.='	  			<option value="0" selected="selected">-Seleccione-</option>';
										foreach($aColores as $colore){	
											$selected ="";			              			
											if($registro->colore_id==$colore->id ){ $selected = "selected='selected'";}
				$texto.='					<option value="'.$colore->id.'" '.$selected.' >'.$colore->color.'</option>';
										} 	
				$texto.='	  		</select>';
				$texto.='		</div>';
				$texto.='	</div>';
				*/
				//********************************

							
				
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

		//*** Si tiene colores activar ***
		if(($_POST['camponombre']=="colore_id")&&($registro->$_POST['camponombre']>0)){
			$colore  = Colore::find($registro->$_POST['camponombre']);
			$texto=utf8_encode($colore->color);
		}
		//***********Fin colores *********

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
		$imagen=$_registroimagen->imagen;

		$directorio="../../".$_POST['directorio'];
		$rutaimagen=$directorio.$imagen;
		if((!empty($imagen)) && (file_exists($rutaimagen)))	
			unlink($rutaimagen);

		//Borrar los thumbnails si existen
		$aMinis=array("m","l","a","g","f");
		foreach($aMinis as $mini){
			$imagenmini=$mini.$imagen;
			$rutaimagen=$directorio.$imagenmini;
			if((!empty($imagenmini)) && (file_exists($rutaimagen)))	
				unlink($rutaimagen);
		}

		$_registroimagen->delete();

		//******** Para el reordenar al eliminar un registro ***
		$pos=$_registroimagen->orden;

		$opciones = array('conditions' => "orden>'".$_registroimagen->orden."'");
		$aRegistros = $Modelo::find("all", $opciones);

		foreach ($aRegistros as $registro) {

			$opciones= array('conditions' => "id='".$registro->id."'");	
			$registro = $Modelo::find( $opciones);

			$registro->orden=$pos;
			$registro->save();
			
			$pos++;
		}
		//*******************************************************

		break;

	//********************************************
	//***********  ORDENAR  *********************
	//********************************************
	case "ordenar":
		// array con el nuevo orden de nuestros registros
		$articulos_ordenados 	= $_POST['cajaimagenes'];
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