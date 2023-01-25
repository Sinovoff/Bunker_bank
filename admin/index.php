<? 
require("header.php");

if(empty($opcion)) $opcion="reservas";

require_once("controladores/".$opcion.".php");

$valor=ucfirst($opcion);
$cRegistros = new $valor();

switch($tipofunc){
	case "copiar":
		$cRegistros->copiar($_GET['id']);
		$cRegistros->index();
		break;
	case "editar":
		$cRegistros->editar($_GET['id']);
		break;
	case "nuevo":
		$cRegistros->nuevo();
		break;
	case "guardar":
		$id=$cRegistros->guardar($_POST['id']);
		if (($opcion=="subcategorias") || ($opcion=="categorias") || ($opcion=="secciones") ){
			if (isset($_POST['btnguardarnuevo'])) {
				$cRegistros->nuevo();
			}else{
				$cRegistros->index($id);
			}
		}else if (($opcion=="productos")||($opcion=="banners") || ($opcion=="noticias")|| ($opcion=="salas") )
				$cRegistros->editar($id);
		else	$cRegistros->index();
		break;
	case "eliminar":
		if ($opcion=="noticias2"){	
			$cRegistros->eliminar($_GET['id'], $_GET['producto_id']);
			if ($_GET['tiporegistro']=="productos"){
				$cRegistros->index();
			}else {
			    $cRegistros->editar($_GET['producto_id']);
			}
		}else{
			$cRegistros->eliminar($_GET['id']);
			$cRegistros->index();
		}
		break;
	default:
		$cRegistros->index();
}

require("footer.php");
?>