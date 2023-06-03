<?require_once ("../init.php");
include ("../funciones.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	

	//*********  ANADIR  ***********************
	case "anadir":
		$options = array('order' => "provincia");			
		$aProvincias = Provincia::find('all',$options);

		$registro  = new $_POST['modelo']();
		$registro->usuario_id		= $_POST['registro_id'];
		$registro->direccionalias	= $_POST['direccionalias'];
		$registro->nombre			= $_POST['nombre'];
		$registro->empresa			= $_POST['empresa'];
		$registro->nif				= $_POST['nif'];
		$registro->direccion		= $_POST['direccion'];
		$registro->cp				= $_POST['cp'];
		$registro->poblacion		= $_POST['poblacion'];
		$registro->provincia		= $_POST['provincia'];
		$registro->paise_id			= $_POST['paise_id'];
		$registro->telefono1		= $_POST['telefono1'];
		$registro->telefono2		= $_POST['telefono2'];
		$registro->save();

		$registro = $_POST['modelo']::last();
		$id = $registro->id;

		$texto='';

		$texto.='<tr>';	
		$texto.='	<td  class="text-center">';
						if($registro->direccionalias==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->direccionalias;
											
		$texto.='		<div id="divtexto_direccionalias_'.$registro->id.'" class="divtexto" data="direccionalias">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_direccionalias_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_direccionalias_'.$registro->id.'" class="form-control input-sm" value="'.$registro->direccionalias.'" data="direccionalias"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->nombre==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->nombre;
											
		$texto.='		<div id="divtexto_nombre_'.$registro->id.'" class="divtexto" data="nombre">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_nombre_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_nombre_'.$registro->id.'" class="form-control input-sm" value="'.$registro->nombre.'" data="nombre"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->empresa==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->empresa;
											
		$texto.='		<div id="divtexto_empresa_'.$registro->id.'" class="divtexto" data="empresa">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_empresa_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_empresa_'.$registro->id.'" class="form-control input-sm" value="'.$registro->empresa.'" data="empresa"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->nif==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->nif;
											
		$texto.='		<div id="divtexto_nif_'.$registro->id.'" class="divtexto" data="nif">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_nif_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_nif_'.$registro->id.'" class="form-control input-sm" value="'.$registro->nif.'" data="nif"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->direccion==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->direccion;
											
		$texto.='		<div id="divtexto_direccion_'.$registro->id.'" class="divtexto" data="direccion">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_direccion_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_direccion_'.$registro->id.'" class="form-control input-sm" value="'.$registro->direccion.'" data="direccion"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->cp==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->cp;
											
		$texto.='		<div id="divtexto_cp_'.$registro->id.'" class="divtexto" data="cp">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_cp_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_cp_'.$registro->id.'" class="form-control input-sm" value="'.$registro->cp.'" data="cp"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->poblacion==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->poblacion;
											
		$texto.='		<div id="divtexto_poblacion_'.$registro->id.'" class="divtexto" data="poblacion">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_poblacion_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_poblacion_'.$registro->id.'" class="form-control input-sm" value="'.$registro->poblacion.'" data="poblacion"/></div>';
		$texto.='	</td>';
		
		$texto.='	<td  class="text-center">';
						if($registro->provincia==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->provincia;
						
		$texto.='		<div id="divtexto_provincia_'.$registro->id.'" class="divtexto" data="provincia">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_provincia_'.$registro->id.'" style="display:none">';
		$texto.='			<select name="inputcamposelect"  id="inputcampo_provincia_'.$registro->id.'" class="inputcamposelect form-control input-sm" data="provincia">';
		$texto.='				<option value="0" selected="selected">-Seleccione-</option>';
								foreach($aProvincias as $provincia){	
									$selected ="";			              			
									if($registro->provincia==$provincia->provincia ){ $selected = "selected='selected'";}
		$texto.='						<option value="'.$provincia->provincia.'" <?echo $selected?> >'.$provincia->provincia.'</option>';
								}
		$texto.='			</select>';
		$texto.='		</div>';
		$texto.='	</td>';

		
		$texto.='		<div id="columnaprovincia_'.$registro->id.'" class="columnaprovincia">'.$registro->provincia.'</div>';
		

		$texto.='	<td  class="text-center">';
						if($registro->paise_id==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=utf8_encode($registro->paise->pais);
											
		$texto.='		<div id="divtexto_pais_'.$registro->id.'" class="divtexto" data="pais">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_pais_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_pais_'.$registro->id.'" class="form-control input-sm" value="'.utf8_encode($registro->paise->pais).'" data="pais"/></div>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
						if($registro->telefono1==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->telefono1;
											
		$texto.='		<div id="divtexto_telefono1_'.$registro->id.'" class="divtexto" data="telefono1">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_telefono1_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_telefono1_'.$registro->id.'" class="form-control input-sm" value="'.$registro->telefono1.'" data="telefono1"/></div>';
		$texto.='	</td>';


		$texto.='	<td  class="text-center">';
						if($registro->telefono2==""){	
							$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
						}else	$botonanadir=$registro->telefono2;
											
		$texto.='		<div id="divtexto_telefono2_'.$registro->id.'" class="divtexto" data="telefono2">'.$botonanadir.'</div>';
		$texto.='		<div id="divinput_telefono2_'.$registro->id.'" style="display:none"><input type="text" name="inputcampo" id="inputcampo_telefono2_'.$registro->id.'" class="form-control input-sm" value="'.$registro->telefono2.'" data="telefono2"/></div>';
		$texto.='	</td>';

		$texto.='	<td class="text-center">';
		$texto.='		<a href="#" class="cambiarcampopredeterminado" id="predeterminado_'.$usuariodireccion->id.'">'. campo_Activo($usuariodireccion->predeterminado).'</a>';
		$texto.='	</td>';

		$texto.='	<td  class="text-center">';
		$texto.='		<a href="#" id="eliminarUsuariodireccion_'.$usuariodireccion->id.'" class="eliminarUsuariodireccion" title="Eliminar"><img src="images/eliminar2.jpg" width="16" height="16" alt="Eliminar" /></a>';
		$texto.='	</td>';
		$texto.='</tr>';

		echo $texto;

		break;

	//*********  MODIFICAR  *********************
	case "modificar":
		$camponombre=$_POST['camponombre'];
		if($camponombre=="paiseid")	$camponombre="paise_id";

		$registro  = $_POST['modelo']::find($_POST['id']);
		$registro->$camponombre= utf8_decode($_POST['campo']);
		$registro->save();

		if(utf8_decode($_POST['campo'])=="")	$texto='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
		else									$texto=$_POST['campo'];

		if($camponombre=="provincia"){
			$provincia  = Provincia::find_by_provincia($registro->$camponombre);
			$texto=utf8_encode($provincia->provincia);
		}
		if(($camponombre=="paise_id")&&($registro->$camponombre>0)){
			$paise  = Paise::find($registro->$camponombre);
			$texto=utf8_encode($paise->pais);
		}

		echo $texto;

		break;
	
	//*********  ELIMINAR  *********************
	case "eliminar":
		// *** Eliminar genero
		$parte_id=explode("_",$_POST['elemento_id']);
		$usuariodireccion_id=$parte_id[1];
		$Modelo=$_POST['modelo'];

		$_registro = Usuariosdireccione::find($usuariodireccion_id);
		$_registro->delete();

		break;

}
?>