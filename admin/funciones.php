<?
function busqueda_campos($textobusqueda, $opcionbusqueda, $arraycampos) {
	if ($textobusqueda!=""){
		if ($opcionbusqueda=="0"){
			$i=0;
			foreach($arraycampos as $campo){
				if ($i==0)	$filtro.=$campo." LIKE '%".utf8_decode($textobusqueda)."%' ";
				else		$filtro.="OR ".$campo." LIKE '%".utf8_decode($textobusqueda)."%' ";
				$i++;
			}
		}else{
			$i=0;
			foreach($arraycampos as $campo){
				if ($i==0)	$filtro.=$campo." LIKE '".utf8_decode($textobusqueda)."' ";
				else		$filtro.="OR ".$campo." LIKE '".utf8_decode($textobusqueda)."' ";
				$i++;
			}
		}
	}else	$filtro=" 1 ";

	return $filtro;
}

function quitar_acentos($texto) {
	$caracteresout= array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","à","è","ì","ò","ù","À","È","Ì","Ò","Ù","ü","Ü","ñ","Ñ","€",chr(34),"&",",",":","$",";","<",">","(",")","¡","!",chr(39),"¿","?","“","”","‘","’"," ","+","ç","Ç","@");
	$caracteresin = array("a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","A","E","I","O","U","u","U","n","N","","","","","","","","","","","","","","","","","","","","","_","","c","C","o");
	$texto=str_replace($caracteresout, $caracteresin, $texto);
	
	return $texto;
}
function random_string($length) {
	$randkey = '';
	$alfabeto = "AaBbCcDdEeFfGgHhIJjKkLMm23456789NnPpQqRrSsTtUuVvWwXxYyZz";
	mt_srand((double)microtime()*1000000);
	for ($i = 0; $i < $length; $i++)
	$randkey .= $alfabeto[mt_rand(0, 55)];
	return $randkey;
}

function generar_referencia($Modelo, $totaldigitos) {
	$registro = $Modelo::last();
	$recidmax = $registro->id;
	$idencriptado=($recidmax+1);
	$digitos=strlen($idencriptado);
	if ($digitos<$totaldigitos) $idencriptado=$idencriptado.random_string($totaldigitos-$digitos);

	return $idencriptado;
}
function generar_referencia_id($id, $totaldigitos) {
	$idencriptado=$id;
	$digitos=strlen($idencriptado);
	if ($digitos<$totaldigitos) $idencriptado=$idencriptado.random_string($totaldigitos-$digitos);

	return $idencriptado;
}
function generar_referencia_aleatoria($totaldigitos) {
	$idencriptado=$idencriptado.random_string($totaldigitos);

	return $idencriptado;
}
function crear_log($fichero, $datos) {
	$fp=fopen($fichero,"a+");
	$maslineas="";

	$linea=$datos."\n";
	
	fputs($fp,$linea);
	fclose($fp);
}



/**********************FECHAS*******************************************/
function seleccionar_fecha($fecha) {
	$f=explode("-",$fecha);
	if(!empty($fecha)) {
		$anno=$f[0];
		$mes=$f[1];
		$dia=$f[2];
	}else {
		$anno=date("Y");
		$mes=date("m");
		$dia=date("d");
	}
	echo $dia."-".$mes."-".$anno;
}
function seleccionar_fechafija($fecha) {
	$f=explode("-",$fecha);
	if(!empty($fecha)) {
		$anno=$f[0];
		$mes=$f[1];
		$dia=$f[2];
	}else {
		$anno="1985";
		$mes="01";
		$dia="01";
	}
	echo $dia."-".$mes."-".$anno;
}


function seleccionar_hora($horas, $ver, $actual){
	//$ver Para ver o no los campos de la hora
	$parteshora=explode(":",$horas);
	if(!empty($horas)) {
		$hora=$parteshora[0];
		$minutos=$parteshora[1];
	}else {
		$hora=date("H");
		if ($actual=="0")	$minutos=date("i");
		else				$minutos="00";
	}

	if((!empty($horas)) || ($ver=="1")) {
		echo "<div class='input-group  col-sm-2'>";
		echo "	  <input type='text' name='hora' id='hora' maxlength=\"2\" value='$hora' class='form-control input-sm text-center' />";
		echo "	  <span class='input-group-addon'>:</span>";
		echo "	  <input type='text' name='minutos' id='minutos' maxlength=\"2\" value='$minutos' class='form-control input-sm text-center' />";
		echo "</div>";
	}else{
		echo "<input type=\"hidden\" name=\"hora\" id=\"hora\" maxlength=\"2\" value=\"$hora\">";
		echo "<input type=\"hidden\" name=\"minutos\" id=\"minutos\"  maxlength=\"2\" value=\"$minutos\">";
	}
}

function seleccionar_horanombre($horas, $ver, $actual, $nombrehora, $nombreminutos){
	//$ver Para ver o no los campos de la hora
	$parteshora=explode(":",$horas);
	if(!empty($horas)) {
		$hora=$parteshora[0];
		$minutos=$parteshora[1];
	}else {
		$hora=date("H");
		if ($actual=="0")	$minutos=date("i");
		else				$minutos="00";
	}

	if((!empty($horas)) || ($ver=="1")) {
		echo "<div class='input-group  col-sm-2'>";
		echo "	<input type='text' name='".$nombrehora."' id='".$nombrehora."'maxlength=\"2\" value='$hora' class='form-control input-sm text-center' />";
		echo "	<span class='input-group-addon'>:</span>";
		echo "<input type='text' name='".$nombreminutos."' id='".$nombreminutos."'  maxlength=\"2\" value='$minutos' class='form-control input-sm text-center' />";
		echo "</div>";
	}else{
		echo "<input type=\"hidden\" name=\"".$nombrehora."\" id=\"".$nombrehora."\" maxlength=\"2\" value=\"".$hora."\">";
		echo "<input type=\"hidden\" name=\"".$nombreminutos."\" id=\"".$nombreminutos."\"  maxlength=\"2\" value=\"".$minutos."\">";
	}
}

function juntar_fechahora($fecha, $hora, $minutos) {	
	$f=explode("-",$fecha);
	$anno=$f[2];
	$mes=$f[1];
	$dia=$f[0];
	$fecha = $anno."-".$mes."-".$dia." ".$hora.":".$minutos;
	
	return $fecha;
}

function fecha_actual($HoraServidor) {
	$fecha=date("Y-m-d H:i", mktime(date("H")+$HoraServidor, date("i"), 0, date("m"), date("d"),  date("Y")));
	return $fecha;
}
/**********************FIN FECHAS*************************************/


function campo_Activo($activo){
	if($activo=="1")	$activo='<img src="images/activo.gif" alt="Si">';
	else				$activo='<img src="images/activono.gif" alt="No">';
	
	return $activo;
}

function campo_EmailOK($activo){
	if($activo=="1")	$activo='<img src="images/emailok.png" alt="Si" >';
	else				$activo='<img src="images/activono.gif" alt="No">';
	
	return $activo;
}

function campo_SEO($seocorrecto){
	if($seocorrecto=="2")		$seocorrecto='<img src="images/ico_verde.png" alt="Correcto">';
	else if($seocorrecto=="1")	$seocorrecto='<img src="images/ico_naranja.png" alt="Aceptable">';
	else						$seocorrecto='<img src="images/ico_rojo.png" alt="Erroneo">';
	
	return $seocorrecto;
}

function formatear_titulourl($titulo) {
	//Poner todo en minuscula
	$titulo=mb_strtolower($titulo);
	//Para formatear el titulo de la url
	$titulopartes=explode(" ",$titulo);
	for ($j=0; $j<count($titulopartes); $j++){
		if(strlen($titulopartes[$j])>0){
			$titulourl=$titulopartes[$j];
			break;
		}
	}	
	for ($i=$j+1; $i<count($titulopartes); $i++){
		$titulourl.="-".$titulopartes[$i];
	}
	//Cambiar caracteres especiales
	$caracteresout=
	array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","à","è","ì","ò","ù","À","È","Ì","Ò","Ù","â","ê","î","ô","û","ü","Ü","ñ","Ñ","€",chr(34),"&",",",".",":","$",";","<",">","(",")","¡","!",chr(39),"¿","?","“","”","‘","’","/","+","º","ª","ç","Ç","ü","Ü","ö","´","---","--");
	$caracteresin = array("a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","A","E","I","O","U","a","e","i","o","u","u","U","n","N","euros","","and","","","","dolar","","","","","","","","","","","","","","","-","","","","c","C","u","U","o","","-","-");
	
	$titulourl=str_replace($caracteresout, $caracteresin, $titulourl);
	
	return $titulourl;
}

 function cortarTexto($texto, $limite, $break=".") {
	//Si el limite es inferior se deja lo mismo
	if(strlen($texto) <= $limite){
		//Añadir punto si el caracter final no lo es
		$ultimocaracter=substr($texto, strlen($texto)-1, 1);
		if($ultimocaracter!="."){
			$texto=substr($texto, 0, strlen($texto)).".";
		}
		return $texto;
	}
	
	// is $break present between $limite and the end of the string
	$breakpoint = strpos($texto, $break, $limite);
	if(false!== $breakpoint) {
		if($breakpoint<(strlen($texto)-1)){
			$texto = substr($texto, 0, $breakpoint);
		}
	}

	//Quitar la coma,.. y sustituirlo por un punto
	$ultimocaracter=substr($texto, strlen($texto)-1, 1);
	if(($ultimocaracter==",") || ($ultimocaracter==":") || ($ultimocaracter==";")){
		$texto=substr($texto, 0, strlen($texto)-1).".";
	}

	//Añadir punto si el caracter final no lo es
	$ultimocaracter=substr($texto, strlen($texto)-1, 1);
	if($ultimocaracter!="."){
		$texto=substr($texto, 0, strlen($texto)).".";
	}

	return $texto;
 }

function irPagina($ruta){?>
	<script type="text/javascript">
		<!--
		window.location.href='<?echo $ruta?>';
		-->
	</script>
<?}

?>