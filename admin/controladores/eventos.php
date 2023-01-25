<?
class Eventos{

	var $opcion="eventos";
	var $Modelo="Evento";

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
			$orden="id";
			$tipoorden="DESC";
			$ordenacion="";
		}
		//******************************************

		//*************** Campos de busqueda ********
		$arraycampos=array("nombre", "empresa");
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

		$registro->paise_id="69";

		$options = array('conditions'=>"activo='1'",'order' => "pais");			
		$aPaises=Paise::find('all',$options);

		$options = array('order' => "provincia");			
		$aProvincias = Provincia::find('all',$options);

		$options = array('order' => "id");			
		$aSalas = Sala::find('all',$options);

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

		$options = array('conditions'=>"activo='1'",'order' => "pais");			
		$aPaises=Paise::find('all',$options);

		$options = array('order' => "provincia");			
		$aProvincias = Provincia::find('all',$options);

		//*** Cargar select de poblaciones segun el usuario
		$opciones=array('conditions'=>"provincia='".$registro->provincia."'");
		$provinciasel = Provincia::find($opciones);
		$provincia_id=str_pad($provinciasel->id, 2 , "0", STR_PAD_LEFT);   
		$opciones=array('conditions'=>"provincia_id='".$provincia_id."'", 'order' =>"poblacion");
		$aPoblaciones= Poblacione::find("all",$opciones);

		$options = array('order' => "id");			
		$aSalas = Sala::find('all',$options);

		require_once("vistas/".$this->opcion."_editar.php");
	}


	function guardar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['tiporegistro']))	$tiporegistro=$_GET['tiporegistro'];
		else								$tiporegistro=$_POST['tiporegistro'];
		
		if ($tiporegistro==$this->opcion){
			$fechareserva = juntar_fechahora($_POST['fechareserva'],$_POST['horareserva'], $_POST['minutoreserva']);

			if($id>0){
				$registro = $Modelo::find($id);
			}else{
				$registro  = new $Modelo();
			}

			$registro->fechareserva	= $fechareserva;
			$registro->nombre		= utf8_decode(addslashes($_POST['nombre']));
			$registro->empresa		= utf8_decode(addslashes($_POST['empresa']));	
			$registro->direccion	= utf8_decode(addslashes($_POST['direccion']));
			$registro->cp			= utf8_decode(addslashes($_POST['cp']));
			$registro->poblacion	= utf8_decode(addslashes($_POST['poblacion']));
			$registro->provincia	= utf8_decode(addslashes($_POST['provincia']));
			$registro->paise_id		= utf8_decode(addslashes($_POST['paise_id']));
			$registro->telefono		= utf8_decode(addslashes($_POST['telefono']));
			$registro->email		= utf8_decode(addslashes($_POST['email']));
			$registro->observaciones= utf8_decode(addslashes($_POST['observaciones']));

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
		}
	}

}
?>