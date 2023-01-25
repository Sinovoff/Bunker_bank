<?class Cupones{

	var $opcion="cupones";
	var $Modelo="Cupone";

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
		$arraycampos=array("referencia", "descripcion");
		$filtro=busqueda_campos($buscar, $buscartipo, $arraycampos);
		//******************************************
		
		//*****Configuracion paginacion ************
		$tamano_pagina="100";
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

			$periododesde = juntar_fechahora($_POST['periododesde'],$_POST['horaperiododesde'], $_POST['minutosperiododesde']);
			$periodohasta = juntar_fechahora($_POST['periodohasta'],$_POST['horaperiodohasta'], $_POST['minutosperiodohasta']);

			if($id>0){
				$registro = $Modelo::find($id);
			}else{
				$registro  = new $Modelo();
			}

			$registro->referencia			= utf8_decode(addslashes($_POST['referencia']));
			$registro->descripcion			= utf8_decode(addslashes($_POST['descripcion']));
			$registro->tipouso				= utf8_decode(addslashes($_POST['tipouso']));
			$registro->periododescuento		= utf8_decode(addslashes($_POST['periododescuento']));
			$registro->periododesde			= utf8_decode(addslashes($periododesde));
			$registro->periodohasta			= utf8_decode(addslashes($periodohasta));
			$registro->descuentotipo		= utf8_decode(addslashes($_POST['descuentotipo']));
			$registro->descuentoporcentaje	= utf8_decode(addslashes($_POST['descuentoporcentaje']));
			$registro->descuentoimporte		= utf8_decode(addslashes($_POST['descuentoimporte']));
			$registro->usado				= utf8_decode(addslashes($_POST['usado']));
			$registro->activo				= utf8_decode(addslashes($_POST['activo']));

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