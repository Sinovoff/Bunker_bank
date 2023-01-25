<?
class Calendarios{

	var $opcion="calendarios";
	var $Modelo="Calendario";

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
			$tipoorden="";
			$ordenacion="DESC";
		}
		//******************************************

		//*************** Campos de busqueda ********
		$arraycampos=array("fecha");
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

		require_once("vistas/".$this->opcion."_editar.php");
	}


	function guardar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['tiporegistro']))	$tiporegistro=$_GET['tiporegistro'];
		else								$tiporegistro=$_POST['tiporegistro'];
		
		if ($tiporegistro==$this->opcion){

			$fecha = juntar_fechahora($_POST['fecha'],"00", "00");

			if($id>0){
				$registro = $Modelo::find($id);
			}else{
				$registro  = new $Modelo();
			}

			$registro->fecha	= $fecha;

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