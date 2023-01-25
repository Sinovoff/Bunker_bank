<?//*************************FUNCIONES para guardar imagenes ******************************
function guardar_imagen_bd($imagen, $Modelo, $letra, $directorio, $id){
	$nombreimg = $_FILES[$imagen]['name'];
	$nombreimg=quitar_acentos($nombreimg);
	if(!empty($nombreimg)){
		if($id>0)
			$nombreimg=$id.$letra."_".$nombreimg;
		else{
			$registro = $Modelo::last();
			$nombreimg=($registro->id+1).$letra."_".$nombreimg;
		}
	}
	if(!empty($imagen)){
		if (is_uploaded_file($_FILES[$imagen]['tmp_name'])) {
			$origen=$_FILES[$imagen]['tmp_name'];
			$destino=$directorio."/".$nombreimg;		
			@copy($origen, $destino);		
			
			if($id>0){	//ya existe el registro se modifica el nombre de la imagen
				$registro = $Modelo::find($id);
				$registro->$imagen	= $nombreimg;
				$registro->save();
			}
		}
	}
	return $nombreimg;
}

function guardar_imagen_bd_multiple($imagen, $Modelo, $letra, $directorio, $id){

	$aNombreimg= $_FILES[$imagen]['name'];
	$aNombretemp=$_FILES[$imagen]['tmp_name'];
	
	for($i=0;$i<count($aNombreimg);$i++){
		$aNombreimg[$i]=quitar_acentos($aNombreimg[$i]);
		if(!empty($aNombreimg[$i])){
			if($id>0)
				$aNombreimg[$i]=$id.$letra."_".$aNombreimg[$i];
			else{
				$registro = $Modelo::last();
				$aNombreimg[$i]=($registro->id+1).$letra."_".$aNombreimg[$i];
			}
		}
		if(!empty($imagen)){
			if (is_uploaded_file($aNombretemp[$i])) {
				$origen=$aNombretemp[$i];
				$destino=$directorio."/".$aNombreimg[$i];		
				@copy($origen, $destino);		
				
				if($id>0){	//ya existe el registro se modifica el nombre de la imagen
					$registro = $Modelo::find($id);
					$registro->$imagen	= $aNombreimg[$i];
					$registro->save();
				}
			}
		}
		$nombreimagen[]=$aNombreimg[$i];
	}
	
	if($nombreimagen!="")	$nombreimg=implode(",",$nombreimagen);
	return $nombreimg;
}

function imagen_Editar($elemento, $directorio, $campo, $modelo, $imagen, $id, $nombrefile, $mini) {
	$rutaimagen=$directorio.$imagen;
	if((file_exists($rutaimagen)) && (!empty($imagen))) {
		$rutaimagenmini=$directorio.$mini.$imagen;

		$textoimagen='	<div class="col-sm-5">';
		$textoimagen.='		<div id="LugarImagen" class="lugarimagen" ><a href="'.$rutaimagen.'" title="'.$imagen.'" class="gallery"><img src="'.$rutaimagenmini.'" class="img-responsive"/></a></div>';
		$textoimagen.='	</div>';
		$textoimagen.='	<div class="col-sm-1">';
		$textoimagen.="		<img src=\"images/eliminar.gif\" title=\"Eliminar\" onClick=\"eliminarImagen('$elemento', '$directorio', '$campo', '$modelo', '$id', '$nombrefile')\" style=\"cursor: pointer\">";
		$textoimagen.='	</div>';
	}else{
		$textoimagen= '<input type="file" name="'.$nombrefile.'" id="'.$nombrefile.'" class="form-control input-sm" />';		
	}
	return $textoimagen;
}

function archivo_Editar($elemento, $directorio, $campo, $modelo, $archivo, $id, $nombrefile) {
	$rutaarchivo=$directorio.$archivo;
	if((file_exists($rutaarchivo)) && (!empty($archivo))) {
		$textoarchivo='	<div class="col-sm-5">';
		$textoarchivo.=		"<a href=\"$rutaarchivo\" target=\"_blank\">".$archivo."</a>";	
		$textoarchivo.='	</div>';
		$textoarchivo.='<div class="col-sm-1">';
		$textoarchivo.=		"<img src=\"images/eliminar.gif\" alt=\"Eliminar\" onClick=\"eliminarImagen('$elemento', '$directorio', '$campo', '$modelo', '$id', '$nombrefile')\" style=\"cursor: pointer\">";
		$textoarchivo.="</div>";
	}else{
		$textoarchivo= '<input type="file" name="'.$nombrefile.'" id="'.$nombrefile.'" class="form-control input-sm" />';
	}
	return $textoarchivo;
}

//*************************FUNCIONES para realizar un THUMBNAIL******************************
function thumbnail($nombrearchivo,$directorio,$directoriomini,$sizex, $sizey, $idnombre){
	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) {	
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	}else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;
	   if ($thumb_x/$imgAncho*$imgAlto>$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);
	 

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			imagealphablending($imagenmini, false);
			imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);
			
		
		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}
			
		}else{
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

	

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		 $thumb_x=$imgAncho;
		 $thumb_y=$imgAlto;
		 //$imagenmini=$rutaimagen;
		 $rutaimagen=$directorio."/".$nombrearchivo;
		 copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

function thumbnail_marcadeagua($nombrearchivo, $imagenmarca, $directorio,$directoriomini,$sizex, $sizey, $idnombre){
	// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
	$marcadeagua = imagecreatefrompng($directorio."/".$imagenmarca);

	$margen_dcho = 10;
	$margen_inf = 10;
	$sx = imagesx($marcadeagua);
	$sy = imagesy($marcadeagua);

	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) {	
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	}else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;
	   if ($thumb_x/$imgAncho*$imgAlto>$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);
	 

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			imagealphablending($imagenmini, false);
			imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);
		
		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}
			
		}else{
			$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

	
		//Posicion de la marca de agua: abajo derecha
		//imagecopy($imagenmini, $marcadeagua, $thumb_x - $sx - $margen_dcho, $thumb_y - $sy - $margen_inf, 0, 0, $sx, $sy);
		//Posicion de la marca de agua: medio medio
		imagecopy($imagenmini, $marcadeagua, round(($thumb_x - $sx)/2), round(($thumb_y - $sy)/2), 0, 0, $sx, $sy);
		//Posicion de la marca de agua: arriba izquierda
		//imagecopy($imagenmini, $marcadeagua, 0, 10, 0, 0, $sx, $sy);

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}
		
	}else{
		$thumb_x=$imgAncho;
		$thumb_y=$imgAlto;
		//$imagenmini=$rutaimagen;
		//$rutaimagen=$directorio."/".$nombrearchivo;
		$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
		$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
		imagefill($imagenmini,0,0,$fondo);
		imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);

		imagecopy($imagenmini, $marcadeagua, 0, 10, 0, 0, $sx, $sy);

		if (($extension=="gif")|| ($extension=="GIF")){
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}
		//copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

function thumbnail_Centrado_Fondo($nombrearchivo,$directorio,$directoriomini,$sizex, $sizey, $idnombre){
	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) 
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	$ratio_orig = $imgAncho/$imgAlto;

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;

	  /* if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

	 */

		if ($thumb_x/$thumb_y > $ratio_orig) {
		   $thumb_x = $thumb_y*$ratio_orig;
		} else {
		   $thumb_y = $thumb_x/$ratio_orig;
		}

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			imagealphablending($imagenmini, false);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);
		
		}else if (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}
		
		}else{
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

		

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		if (($extension=="jpg")|| ($extension=="JPG")||($extension=="jpeg")|| ($extension=="JPEG")){
			//Habilitar si se quiere realizar siempre aunque sea la medida real para que reduzca calidad y tamano
			$thumb_x=$sizex;
			$thumb_y=$sizey;

			if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
			   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
			else
			  $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);

			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}else{
			$thumb_x=$imgAncho;
			$thumb_y=$imgAlto;
			$rutaimagen=$directorio."/".$nombrearchivo;
			copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
		}
			
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

//*************************FUNCIONES para realizar un THUMBNAIL******************************
function thumbnail_conRecorte($nombrearchivo,$directorio,$directoriomini,$sizex, $sizey, $idnombre){
	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) 
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;

	   if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			imagealphablending($imagenmini, false);
			imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);
		
		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}
		
		}else{
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

		

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		 $thumb_x=$imgAncho;
		 $thumb_y=$imgAlto;
		 //$imagenmini=$rutaimagen;
		 $rutaimagen=$directorio."/".$nombrearchivo;
		 copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

function thumbnail_conRecorte_Centrado($nombrearchivo,$directorio,$directoriomini,$sizex, $sizey, $idnombre){
	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) 
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;

	   if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			imagealphablending($imagenmini, false);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);
		
		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}
		
		}else{
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

		

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		if (($extension=="jpg")|| ($extension=="JPG")||($extension=="jpeg")|| ($extension=="JPEG")){
			//Habilitar si se quiere realizar siempre aunque sea la medida real para que reduzca calidad y tamano
			$thumb_x=$sizex;
			$thumb_y=$sizey;

			if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
			   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
			else
			  $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);

			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}else{
			$thumb_x=$imgAncho;
			$thumb_y=$imgAlto;
			$rutaimagen=$directorio."/".$nombrearchivo;
			copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
		}
			
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

function thumbnail_conRecorte_marcadeagua($nombrearchivo, $imagenmarca, $directorio,$directoriomini,$sizex, $sizey, $idnombre){
	// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
	$marcadeagua = imagecreatefrompng($directorio."/".$imagenmarca);

	$margen_dcho = 10;
	$margen_inf = 10;
	$sx = imagesx($marcadeagua);
	$sy = imagesy($marcadeagua);

	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) 
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;

	   if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);

		if (($extension=="png")|| ($extension=="PNG")){ 
			//Reducir imagen y aplicar transparencia si la tiene
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			imagealphablending($imagenmini, false);
			imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			imagesavealpha($imagenmini, true);

		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled($imagenmini,$rutaimagen,0,0,0,0,$thumb_x,$thumb_y,$imgAncho,$imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}

		}else{
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}

		imagecopy($imagenmini, $marcadeagua, 0, 10, 0, 0, $sx, $sy);

		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		$thumb_x=$imgAncho;
		$thumb_y=$imgAlto;
		//$imagenmini=$rutaimagen;
		//$rutaimagen=$directorio."/".$nombrearchivo;
		$imagenmini= imagecreatetruecolor($thumb_x, $thumb_y);
		$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
		imagefill($imagenmini,0,0,$fondo);
		imagecopyresampled($imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);

		imagecopy($imagenmini, $marcadeagua, 0, 10, 0, 0, $sx, $sy);

		if (($extension=="gif")|| ($extension=="GIF")){
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

function thumbnail_Reflejo($nombrearchivo, $directorio) {
	//NOTA:El archivo tiene que ser png para que el reflejo tenga menos opacidad que el original.

	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];

	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) {	
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	}else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 


	//Tamaño imagen
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 
	
	$dest_height = $imgAlto + ($imgAlto / 2);
	$dest_width = $imgAncho;

	$imagenreflejo = imagecreatetruecolor($dest_width, $dest_height);
	imagealphablending($imagenreflejo, false);
	imagesavealpha($imagenreflejo, true);

	imagecopy($imagenreflejo, $rutaimagen, 0, 0, 0, 0, $imgAncho, $imgAlto);
	$altura_reflejo = $imgAlto / 2;
	$alpha_step = 80 / $altura_reflejo;
	for ($y = 1; $y <= $altura_reflejo; $y++) {
		for ($x = 0; $x < $dest_width; $x++) {
		  // copy pixel from x / $imgAlto - y to x / $imgAlto + y
		  $rgba = imagecolorat($rutaimagen, $x, $imgAlto - $y);
		  $alpha = ($rgba & 0x7F000000) >> 24;
		  $alpha =  max($alpha, 47 + ($y * $alpha_step));
		  $rgba = imagecolorsforindex($rutaimagen, $rgba);
		  $rgba = imagecolorallocatealpha($imagenreflejo, $rgba['red'], $rgba['green'], $rgba['blue'], $alpha);
		  imagesetpixel($imagenreflejo, $x, $imgAlto + $y - 1, $rgba);
		}
	}
  
	if (($extension=="gif")|| ($extension=="GIF")){
		imagegif($imagenreflejo,$directorio."/".$nombrearchivo);
	}else if (($extension=="png")|| ($extension=="PNG")){ 
		imagepng($imagenreflejo,$directorio."/".$nombrearchivo,"0");
	}else{
		imagejpeg($imagenreflejo,$directorio."/".$nombrearchivo,"90");
	}

	return $nombrearchivo;
}

//*************************FUNCION para realizar un THUMBNAIL******************************
function thumbnail_Centrado($nombrearchivo,$directorio,$directoriomini,$sizex, $sizey, $idnombre){
	//******************   Inicio thumbnail   ****************
	//Sacar la extension del archivo
	$palabras=explode(".",$nombrearchivo);
	$extension=$palabras[count($palabras)-1];


	//Crear imagen
	if (($extension=="gif")|| ($extension=="GIF")) 
		$rutaimagen = imagecreatefromgif($directorio."/".$nombrearchivo); 
	else if (($extension=="png")|| ($extension=="PNG")) 
		$rutaimagen = imagecreatefrompng($directorio."/".$nombrearchivo); 
	else 
		$rutaimagen = imagecreatefromjpeg($directorio."/".$nombrearchivo); 

	//Tamaño real
	$imgAncho = imagesx ($rutaimagen); 
	$imgAlto =imagesy($rutaimagen); 

	//Tamaño reducido
	if ($imgAncho>$sizex || $imgAlto>$sizey){
	   $thumb_x=$sizex;
	   $thumb_y=$sizey;

	   if ($thumb_x/$imgAncho*$imgAlto<$thumb_y)
		   $thumb_x=round($thumb_y*$imgAncho/$imgAlto);
	   else
		   $thumb_y=round($thumb_x*$imgAlto/$imgAncho);


		if (($extension=="png")|| ($extension=="PNG")){ 
				//Reducir imagen y aplicar transparencia si la tiene
				$imagenmini= imagecreatetruecolor($sizex, $sizey);
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
		}elseif (($extension=="gif")|| ($extension=="GIF")){ 	
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$colorTransparancia=imagecolortransparent($rutaimagen);// devuelve el color usado como transparencia o -1 si no tiene transparencias
			if($colorTransparancia!=-1){ //SI TIENE TRANSPARENCIA
				$colorTransparente = imagecolorsforindex($rutaimagen, $colorTransparancia); 
				$idColorTransparente = imagecolorallocatealpha($imagenmini, $colorTransparente['red'], $colorTransparente['green'], $colorTransparente['blue'], $colorTransparente['alpha']); 
				imagefill($imagenmini, 0, 0, $idColorTransparente);
				imagecolortransparent($imagenmini, $idColorTransparente); 
				imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			}else{
				imagealphablending($imagenmini, false);
				imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
				imagesavealpha($imagenmini, true);
			}

			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagefilledrectangle($imagenmini,0,0,$sizex-1,$sixey-1,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
			//imagecopyresampled( $imagenmini, $rutaimagen, 0, 0, 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}else{
			$imagenmini= imagecreatetruecolor($sizex, $sizey);
			$fondo = imagecolorallocate($imagenmini, 255, 255, 255);
			imagefill($imagenmini,0,0,$fondo);
			imagefilledrectangle($imagenmini,0,0,$sizex-1,$sixey-1,$fondo);
			imagecopyresampled( $imagenmini, $rutaimagen, round(($sizex-$thumb_x)/2), round(($sizey-$thumb_y)/2), 0, 0, $thumb_x, $thumb_y, $imgAncho, $imgAlto);
		}


		if (($extension=="gif")|| ($extension=="GIF")){
			//header('Content-type: image/gif');
			imagegif($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo);
		}else if (($extension=="png")|| ($extension=="PNG")){ 
			//header('Content-type: image/png');
			imagepng($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"0");
		}else{
			//header('Content-type: image/jpg');
			imagejpeg($imagenmini,$directoriomini."/".$idnombre.$nombrearchivo,"90");
		}

	}else{
		 $thumb_x=$imgAncho;
		 $thumb_y=$imgAlto;
		 //$imagenmini=$rutaimagen;
		 $rutaimagen=$directorio."/".$nombrearchivo;
		 copy($rutaimagen, $directorio."/".$idnombre.$nombrearchivo);
	}
	
	//*********************   Fin thumbnail   *****************

	return $idnombre.$nombrearchivo;
}

?>