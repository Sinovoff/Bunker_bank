<?
class Galerias{

	var $opcion="galerias";
	var $Modelo="Galeria";

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
			$orden="orden";
			$tipoorden="";
			$ordenacion="DESC";
		}
		//******************************************

		//*************** Campos de busqueda ********
		$arraycampos=array("titulo");
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

			$nombreimagen=guardar_imagen_bd("imagen", "Galeria", "", "../galeria", $id);			
			if ($nombreimagen!=""){
				$nombremini=thumbnail($nombreimagen,"../galeria","../galeria","1280","853","");
				$nombremini=thumbnail_conRecorte_Centrado($nombreimagen,"../galeria","../galeria","600","400","l");
			}

			$options = array('limit' => 1, 'offset' => 0, 'order' => "orden DESC",);	
			$registroorden = $Modelo::find($options);
			$ordencampo=$registroorden->orden+1;	
			
			if($id>0){
				$registro = $Modelo::find($id);
			}else{
				$registro  = new $Modelo();
				$registro->imagen			= $nombreimagen;
				$registro->orden			= $ordencampo;
			}

			$registro->titulo		= utf8_decode(addslashes(trim($_POST['titulo'])));
			$registro->destacado	= utf8_decode(addslashes(trim($_POST['destacado'])));
			$registro->activo		= utf8_decode(addslashes(trim($_POST['activo'])));

			$registro->save();

			if($id<=0){
				$registro = $Modelo::last();
				$id = $registro->id;
			}
		
		}
		return $id;
	}


	function eliminar($id){
		$Modelo=$this->Modelo;

		if (!empty($_GET['tiporegistro']))	$tiporegistro=$_GET['tiporegistro'];
		else								$tiporegistro=$_POST['tiporegistro'];

		if ($tiporegistro==$this->opcion){
			$registro = $Modelo::find($id);
			$imagen=$registro->imagen;
			$registro->delete();

			if((file_exists("../imagenes/portadas/".$imagen)) && (!empty($imagen)))
				unlink("../imagenes/portadas/".$imagen);	

		}
	}

}
?>