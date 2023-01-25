<?
class Salas{

	var $opcion="salas";
	var $Modelo="Sala";

	function index(){
		$Modelo=$this->Modelo;

		if (!empty($_GET['inicio']))		$inicio=$_GET['inicio'];
		else								$inicio=$_POST['inicio'];
		if(empty($inicio))					$inicio=0;

		if (!empty($_GET['buscar']))		$buscar=$_GET['buscar'];
		else								$buscar=$_POST['buscar'];

		if (!empty($_GET['buscartipo']))	$buscartipo=$_GET['buscartipo'];
		else								$buscartipo=$_POST['buscartipo'];
		if(empty($buscartipo))				$buscartipo=0;

		if (!empty($_GET['ordenacion']))	$ordenacion=$_GET['ordenacion'];
		else								$ordenacion=$_POST['ordenacion'];

		if (!empty($_GET['orden']))			$orden=$_GET['orden'];
		else								$orden=$_POST['orden'];

		//*************** Ordenacion ***************
		if($ordenacion=="DESC") $tipoorden="";
		else $tipoorden="DESC";

		if (empty($orden)){
			$orden="fecha";
			$tipoorden="DESC";
			$ordenacion="";
		}
		//******************************************

		//*************** Campos de busqueda ********
		$arraycampos=array("fecha", "nombre", "precio", "precio2");
		$filtro=busqueda_campos($buscar, $buscartipo, $arraycampos);


		//******************************************
		
		//*****Configuracion paginacion ************
		$tamano_pagina="50";
		$numero_paginas="5";	
		//******************************************
		$options = array('conditions' => $filtro, 'limit' => $tamano_pagina, 'offset' => $inicio, 'order' => $orden." ".$tipoorden);	
		$options2 = array('conditions' => $filtro);
	
		$arrayRegistros = $Modelo::find('all',$options);	
		$numeroRegistros  = Count($Modelo::find('all',$options2));

	
		require_once("vistas/".$this->opcion."_index.php");	
	}


	function nuevo(){

		$Modelo=$this->Modelo;

		$registro = new $Modelo();

		$options = array('conditions' => "sala_id='".$registro->id."'", 'order' => "id");			
		$aSalashoras = Salashora::find('all',$options);

		
		require_once("vistas/".$this->opcion."_editar.php");	
	}
	
	function editar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['inicio']))		$inicio=$_GET['inicio'];
		else								$inicio=$_POST['inicio'];
		if(empty($inicio))					$inicio=0;

		if (!empty($_GET['buscar']))		$buscar=$_GET['buscar'];
		else								$buscar=$_POST['buscar'];

		if (!empty($_GET['buscartipo']))	$buscartipo=$_GET['buscartipo'];
		else								$buscartipo=$_POST['buscartipo'];
		if(empty($buscartipo))				$buscartipo=0;

		if (!empty($_GET['ordenacion']))	$ordenacion=$_GET['ordenacion'];
		else								$ordenacion=$_POST['ordenacion'];

		if (!empty($_GET['orden']))			$orden=$_GET['orden'];
		else								$orden=$_POST['orden'];


		$registro = $Modelo::find($id);	

		$options = array('conditions' => "sala_id='".$registro->id."'", 'order' => "id");			
		$aSalashoras = Salashora::find('all',$options);

		require_once("vistas/".$this->opcion."_editar.php");
	}


	function guardar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['tiporegistro']))	$tiporegistro=$_GET['tiporegistro'];
		else								$tiporegistro=$_POST['tiporegistro'];
		
		if ($tiporegistro==$this->opcion){

			//******* SEO ***************************
			//**** Titulos y urls ***
			if (!empty($_POST['titulourl']))			$titulourl=utf8_decode(trim($_POST['titulourl']));
			else										$titulourl=utf8_decode(formatear_titulourl(trim($_POST['nombre'])));

			if (!empty($_POST['tituloseo']))			$tituloseo=utf8_decode(trim($_POST['tituloseo']));
			else{
				if(trim($_POST['nombre'])!="")			$tituloseo=utf8_decode(trim(ucfirst(mb_strtolower($_POST['nombre'])))).METAFINAL;
			}

			$tituloseoh1=utf8_decode(trim($_POST['titulo']));

			if (!empty($_POST['descripcionseo']))		$descripcionseo=utf8_decode(trim($_POST['descripcionseo']));
			else{	
				if(trim($_POST['descripcion'])!=""){				
														$descripcionseo=strip_tags(utf8_decode(trim($_POST['descripcion'])));
														$descripcionseo = cortarTexto($descripcionseo, 150, " ");
				}
			}

			//**** SEO correcto ***
			if((strlen($tituloseo)<30) || (strlen($tituloseo)>65))				$correcto='No';
			if(strlen($tituloseoh1)>70)											$correcto='No';
			if((strlen($descripcionseo)<70) || (strlen($descripcionseo)>156))	$correcto='No';

			if((strlen($tituloseo)==0))			$correcto='Vacio';
			if(strlen($tituloseoh1)==0)			$correcto='Vacio';
			if((strlen($descripcionseo)==0))	$correcto='Vacio';

			if($correcto=="Vacio")		$seocorrecto="0";
			else if($correcto=="No")	$seocorrecto="1";
			else						$seocorrecto="2";
			//*********************************************

			if($id>0){
				$registro = $Modelo::find($id);
			}else{
				$registro  = new $Modelo();
			}

			$registro->nombre				= utf8_decode(addslashes($_POST['nombre']));
			$registro->descripcion			= utf8_decode(addslashes($_POST['descripcion']));
			$registro->precio				= utf8_decode(addslashes($_POST['precio']));
			$registro->precio2				= utf8_decode(addslashes($_POST['precio2']));
			$registro->activo				= utf8_decode(addslashes($_POST['activo']));
			$registro->titulourl			= $titulourl;
			$registro->tituloseo			= addslashes(trim($tituloseo));
			$registro->tituloseoh1			= addslashes(trim($tituloseoh1));
			$registro->descripcionseo		= addslashes(trim($descripcionseo));
			$registro->seocorrecto			= $seocorrecto;

			$registro->save();

			$id = $registro->id;
		
		}
		return $id;
	}


	function eliminar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['tiporegistro']))	$tiporegistro=$_GET['tiporegistro'];
		else								$tiporegistro=$_POST['tiporegistro'];

		if ($tiporegistro==$this->opcion){
			$registro = $Modelo::find($id);
			$registro->delete();

			//Horarios de las salas
			$opciones = array('conditions' => "sala_id='".$id."'");			
			$aSalashoras= Salashora::find('all',$opciones);
			foreach($aSalashoras as $salahora){
				$salahora->delete();
			}

		}
	}

}
?>